<?php

namespace Tests\Feature;

use App\Services\PartnerCoursesClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PartnerCoursesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'course_catalog.base_url' => 'https://partner.test',
            'course_catalog.token' => '1|secret-token',
        ]);
        Cache::flush();
    }

    private function course(string $slug, array $extra = []): array
    {
        return array_merge([
            'id' => 1,
            'slug' => $slug,
            'url' => "https://partner.test/courses/{$slug}",
            'title' => ucfirst($slug),
            'details' => '<p>About this course</p>',
            'price' => 5000,
            'original_price' => null,
            'discount_percentage' => 0,
            'image_url' => null,
            'has_certificate' => true,
            'is_lifetime_access' => true,
            'access_duration_months' => null,
            'category' => ['id' => 1, 'name' => 'Wellness', 'slug' => 'wellness'],
            'weeks' => [['resources' => [['youtube_url' => 'https://youtu.be/gated']]]],
            'materials' => [['download_url' => 'https://partner.test/gated.pdf']],
        ], $extra);
    }

    public function test_pulled_courses_keep_canonical_url_and_drop_gated_content(): void
    {
        Http::fake(['partner.test/api/courses*' => Http::response([
            'data' => [$this->course('alpha')],
            'meta' => ['last_page' => 1],
        ])]);

        $list = app(PartnerCoursesClient::class)->publicList();

        $this->assertCount(1, $list);
        $this->assertSame('https://partner.test/courses/alpha', $list[0]['url']);
        $this->assertArrayNotHasKey('weeks', $list[0]);
        $this->assertArrayNotHasKey('materials', $list[0]);

        Http::assertSent(fn (Request $r) => $r->hasHeader('Authorization', 'Bearer 1|secret-token'));
    }

    public function test_url_falls_back_to_slug_on_partner_base_when_omitted(): void
    {
        Http::fake(['partner.test/api/courses*' => Http::response([
            'data' => [$this->course('beta', ['url' => null])],
            'meta' => ['last_page' => 1],
        ])]);

        $this->assertSame('https://partner.test/courses/beta', app(PartnerCoursesClient::class)->publicList()[0]['url']);
    }

    public function test_every_page_is_fetched(): void
    {
        Http::fake([
            'partner.test/api/courses?page=1*' => Http::response(['data' => [$this->course('one')], 'meta' => ['last_page' => 2]]),
            'partner.test/api/courses?page=2*' => Http::response(['data' => [$this->course('two')], 'meta' => ['last_page' => 2]]),
        ]);

        $slugs = array_column(app(PartnerCoursesClient::class)->publicList(), 'slug');

        $this->assertSame(['one', 'two'], $slugs);
    }

    public function test_api_failure_yields_empty_list_and_backs_off(): void
    {
        Http::fake(['partner.test/api/courses*' => Http::response('boom', 500)]);

        $client = app(PartnerCoursesClient::class);

        $this->assertSame([], $client->publicList());
        $this->assertSame([], $client->publicList());
        Http::assertSentCount(1);
    }

    public function test_unconfigured_makes_no_requests(): void
    {
        config(['course_catalog.base_url' => null, 'course_catalog.token' => null]);
        Http::fake();

        $this->assertSame([], app(PartnerCoursesClient::class)->publicList());
        Http::assertNothingSent();
    }

    public function test_courses_page_links_out_to_pulled_courses(): void
    {
        Http::fake(['partner.test/api/courses*' => Http::response([
            'data' => [$this->course('gamma', ['title' => 'Gamma Course'])],
            'meta' => ['last_page' => 1],
        ])]);

        $this->get('/courses')
            ->assertOk()
            ->assertSee('Gamma Course')
            ->assertSee('href="https://partner.test/courses/gamma"', false)
            ->assertDontSee('Courses Coming Soon')
            ->assertDontSee('gated.pdf');
    }

    public function test_courses_page_still_renders_when_api_is_down(): void
    {
        Http::fake(['partner.test/api/courses*' => Http::response('boom', 500)]);

        $this->get('/courses')->assertOk()->assertSee('Courses Coming Soon');
    }
}
