<?php

namespace App\Services;

use App\Exceptions\PartnerCoursesApiException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PartnerCoursesClient
{
    private const CACHE_KEY = 'partner_courses.public_list';

    private const BACKOFF_KEY = 'partner_courses.backoff';

    public function isConfigured(): bool
    {
        return filled(config('course_catalog.base_url')) && filled(config('course_catalog.token'));
    }

    /**
     * Every published partner course, reduced to the public allow-list with
     * a link back to the course's real page on the partner site. Never
     * throws: a missing config or an unreachable API yields an empty list
     * so the page still renders its local courses.
     *
     * @return array<int, array<string, mixed>>
     */
    public function publicList(): array
    {
        if (! $this->isConfigured() || Cache::has(self::BACKOFF_KEY)) {
            return [];
        }

        try {
            return Cache::remember(
                self::CACHE_KEY,
                (int) config('course_catalog.cache_ttl'),
                fn () => $this->fetchAll()
            );
        } catch (PartnerCoursesApiException $e) {
            Log::error('Partner courses API request failed.', ['error' => $e->getMessage()]);
            Cache::put(self::BACKOFF_KEY, true, (int) config('course_catalog.failure_backoff'));

            return [];
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    protected function fetchAll(): array
    {
        $courses = [];
        $page = 1;

        do {
            $response = $this->send(
                fn () => $this->request()->get('/api/courses', ['page' => $page, 'per_page' => 100])
            );

            if (! $response->successful()) {
                throw new PartnerCoursesApiException(
                    "Partner courses API returned {$response->status()} for course list."
                );
            }

            $body = $response->json();

            foreach ($body['data'] ?? [] as $course) {
                $courses[] = $this->toPublicArray($course);
            }

            $lastPage = (int) ($body['meta']['last_page'] ?? 1);
            $page++;
        } while ($page <= $lastPage);

        return $courses;
    }

    /**
     * @param  array<string, mixed>  $course
     * @return array<string, mixed>
     */
    protected function toPublicArray(array $course): array
    {
        $safe = Arr::only($course, config('course_catalog.public_fields', []));

        // The partner supplies the canonical page for each course; the
        // slug-built URL only covers a response that omits it.
        $safe['url'] = ! empty($course['url'])
            ? $course['url']
            : rtrim((string) config('course_catalog.base_url'), '/').'/courses/'.($course['slug'] ?? '');

        return $safe;
    }

    protected function request(): PendingRequest
    {
        return Http::withToken(config('course_catalog.token'))
            ->baseUrl(rtrim((string) config('course_catalog.base_url'), '/'))
            ->timeout((int) config('course_catalog.timeout'))
            // The partner app sleeps when idle on Laravel Cloud, so the
            // first request after a quiet spell can miss a short timeout.
            // Retry connection failures only; real HTTP errors (401, 5xx)
            // are inspected by the caller, not retried or thrown here.
            ->retry(2, 1500, when: fn ($exception) => $exception instanceof ConnectionException, throw: false)
            ->acceptJson();
    }

    /**
     * @param  callable(): Response  $callback
     */
    protected function send(callable $callback): Response
    {
        try {
            return $callback();
        } catch (ConnectionException $e) {
            throw new PartnerCoursesApiException('Could not reach the partner courses API.', previous: $e);
        }
    }
}
