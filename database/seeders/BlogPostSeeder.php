<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $content1 = <<<'HTML'
<h2>What Is Trauma — And Why Does the Body Remember?</h2>

<p>Trauma is not just a memory stored in the mind. It is an experience that lives in the cells, the muscles, the nervous system — and often, in the silence we carry long after the event has passed. The body keeps the score, as the renowned psychiatrist Bessel van der Kolk wrote, and nowhere is this truth more evident than in the lives of those who have suffered deeply and yet cannot quite explain why they still flinch at a particular sound, freeze in certain rooms, or weep without knowing why.</p>

<p>As a psycho-trauma therapist, I have sat across from executives who cannot sleep, mothers who dissociate mid-sentence, young men who rage without knowing why, and elderly women still carrying the weight of things that happened to them as little girls. In every case, the common thread is this: <strong>the body never forgets</strong>, even when the conscious mind desperately tries to.</p>

<blockquote>
  <p>"Trauma is not what happened to you. Trauma is what happened <em>inside</em> you as a result of what happened to you." — Gabor Maté</p>
</blockquote>

<h2>The Three Layers of Trauma Response</h2>

<p>Understanding why trauma lingers requires us to appreciate how the brain processes threat. When we encounter danger — real or perceived — the brain activates three distinct responses in rapid succession:</p>

<ol>
  <li><strong>Fight:</strong> The impulse to confront and eliminate the threat.</li>
  <li><strong>Flight:</strong> The urge to escape and create distance from danger.</li>
  <li><strong>Freeze:</strong> When neither fight nor flight is possible, the system shuts down — like a rabbit playing dead.</li>
</ol>

<p>These responses are not weaknesses. They are brilliant survival mechanisms. The tragedy is that for many trauma survivors, the nervous system becomes <em>stuck</em> in one of these states — long after the original threat is gone. The person is physically safe but neurologically still at war.</p>

<h2>Faith as a Pathway — Not Just a Platitude</h2>

<p>In Nigeria and across the African continent, faith is woven into the very fabric of how we understand suffering, resilience, and healing. And yet, for too long, spiritual communities have offered well-meaning but unhelpful responses to trauma: <em>"Just pray harder," "Give it to God," "Move on — you are healed."</em></p>

<p>I want to be clear: I believe deeply in the power of prayer. I believe in God's capacity to heal. But I also believe that God created the human mind with extraordinary complexity — and that healing that honours Him must engage that complexity, not bypass it.</p>

<blockquote>
  <p>God designed the mind just as He designed the soul — and true healing must honour both. This is why faith and science must walk together.</p>
</blockquote>

<h2>Five Signs You May Still Be Carrying Unprocessed Trauma</h2>

<p>Trauma does not always look like PTSD flashbacks. It can be quieter, more subtle — hiding behind what looks like personality or habit. Here are five signs worth paying attention to:</p>

<ul>
  <li><strong>Hypervigilance:</strong> You are always scanning the room, always waiting for something to go wrong, unable to relax even in safe environments.</li>
  <li><strong>Emotional numbness:</strong> You feel disconnected from your own feelings — going through the motions of life without truly experiencing joy, grief, or love.</li>
  <li><strong>Disproportionate reactions:</strong> Small things trigger large responses — a tone of voice, a smell, a phrase — and you cannot quite explain why.</li>
  <li><strong>Relationship patterns:</strong> You consistently attract or recreate dynamics that mirror the original wound — without realising you are doing so.</li>
  <li><strong>Somatic complaints:</strong> Chronic pain, digestive issues, fatigue, or tension with no clear medical cause — the body expressing what the mind cannot.</li>
</ul>

<h2>A Word for the Person Reading This in Secret</h2>

<p>Perhaps you found this article because you have been quietly struggling — telling everyone you are fine, going to church on Sundays, showing up for your family — but inside, something feels broken. Something you cannot name. Something old.</p>

<p>You are not broken. You are <em>wounded</em>. And wounds, when properly tended, heal.</p>

<p>There is no shame in needing help. In fact, seeking help is one of the most courageous acts a person can take. If what you have read here resonates with you, I want to invite you to take one step — reach out. Not to fix everything at once, but simply to begin.</p>

<hr>

<p><em>Dr. Mrs. Anthonia Yemisi Soje is a board-certified psycho-trauma therapist, medical doctor, and Founder of Fosterheirs Mental Health Consultancy. She sees clients in Lagos and offers virtual sessions across Nigeria and the diaspora.</em></p>
HTML;

        $content2 = <<<'HTML'
<h2>What the Church Got Wrong About Addiction</h2>

<p>For too long, addiction has been treated as a character flaw — evidence of weak will, insufficient prayer, or moral failure. This view has caused immeasurable harm. It has driven suffering people away from the very communities that should be their greatest source of support.</p>

<p>The truth is more complex, more compassionate, and ultimately more hopeful: addiction is a <strong>brain disease</strong>, deeply intertwined with trauma, genetics, and unmet emotional needs. Understanding this is the first step toward genuine recovery.</p>

<blockquote>
  <p>"Addiction begins with the hope that something out there can instantly fill up the emptiness inside." — Jean Kilbourne</p>
</blockquote>

<h2>The Neuroscience of Addiction</h2>

<p>When a person uses a substance repeatedly, the brain's reward system is hijacked. Dopamine — the neurotransmitter associated with pleasure, motivation, and connection — floods the system in unnaturally high concentrations. Over time, the brain compensates by reducing its own dopamine production and sensitivity.</p>

<p>The result: the person needs the substance just to feel <em>normal</em>. Without it, they experience anxiety, depression, physical pain, and an overwhelming craving that no amount of willpower alone can overcome.</p>

<h2>The Path Forward</h2>

<p>Recovery from addiction is possible. I have witnessed it hundreds of times. But it requires an integrated approach — medical support, psychological therapy, community, and for many, spiritual grounding. If you or someone you love is struggling, please reach out. Help is available.</p>

<hr>

<p><em>Dr. Soje leads addiction recovery programmes at Fosterheirs Mental Health Consultancy. Contact us to learn more about our approach.</em></p>
HTML;

        BlogPost::updateOrCreate(
            ['slug' => 'understanding-trauma-why-your-body-remembers'],
            [
                'title'          => 'Understanding Trauma: Why Your Body Remembers What Your Mind Tries to Forget',
                'slug'           => 'understanding-trauma-why-your-body-remembers',
                'excerpt'        => 'Trauma is not just a memory stored in the mind — it lives in the body, the nervous system, and the silences we carry. Here is what that means for healing, and why faith and science must walk together.',
                'content'        => $content1,
                'category'       => 'Mental Health',
                'status'         => 'published',
                'read_time'      => 7,
                'views'          => 142,
                'featured_image' => null,
                'published_at'   => now()->subDays(3),
            ]
        );

        BlogPost::updateOrCreate(
            ['slug' => 'breaking-the-stigma-addiction-is-not-a-moral-failure'],
            [
                'title'          => 'Breaking the Stigma: Addiction Is Not a Moral Failure',
                'slug'           => 'breaking-the-stigma-addiction-is-not-a-moral-failure',
                'excerpt'        => 'The church often responds to addiction with condemnation, and families respond with shame. But science and Scripture tell a different story — one of biology, trauma, and the possibility of lasting freedom.',
                'content'        => $content2,
                'category'       => 'Addiction & Recovery',
                'status'         => 'published',
                'read_time'      => 5,
                'views'          => 89,
                'featured_image' => null,
                'published_at'   => now()->subDays(10),
            ]
        );
    }
}
