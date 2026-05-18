<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title'       => 'Faith & Mental Health Integration',
                'description' => 'At the heart of Dr. Soje\'s practice is the conviction that Christian faith and clinical psychology are not rivals — they are partners. Every session, every talk, every book is anchored in the Word and backed by science.',
                'color'       => '#C9922A',
                'icon'        => 'sparkles',
                'is_featured' => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Psycho-trauma Therapy',
                'description' => 'Evidence-based trauma processing for individuals dealing with post-traumatic stress and deep emotional wounds.',
                'color'       => '#3B82F6',
                'icon'        => 'brain',
                'is_featured' => false,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Addiction Recovery',
                'description' => 'Comprehensive drug and alcohol rehabilitation combining medical intervention, psychological therapy, and spiritual support.',
                'color'       => '#F59E0B',
                'icon'        => 'anchor',
                'is_featured' => false,
                'sort_order'  => 3,
            ],
            [
                'title'       => 'Marriage Counselling',
                'description' => 'Restoring and strengthening marital bonds through conflict resolution, communication, and faith-based rebuilding.',
                'color'       => '#2E7D63',
                'icon'        => 'heart',
                'is_featured' => false,
                'sort_order'  => 4,
            ],
            [
                'title'       => 'ADHD Specialist',
                'description' => 'Specialised assessment and structured management for ADHD in children and adults, with lasting behavioural frameworks.',
                'color'       => '#8B5CF6',
                'icon'        => 'zap',
                'is_featured' => false,
                'sort_order'  => 5,
            ],
            [
                'title'       => 'Life Coaching',
                'description' => 'Goal-oriented coaching to help individuals discover purpose, build resilience, and unlock their fullest God-given potential.',
                'color'       => '#F97316',
                'icon'        => 'compass',
                'is_featured' => false,
                'sort_order'  => 6,
            ],
            [
                'title'       => 'Premarital Counselling',
                'description' => 'Equipping couples with communication skills, aligned expectations, and faith foundations before marriage begins.',
                'color'       => '#EC4899',
                'icon'        => 'gem',
                'is_featured' => false,
                'sort_order'  => 7,
            ],
            [
                'title'       => 'Emotional Wellness',
                'description' => 'Ongoing support for emotional health, identity, self-worth, and resilience — mentoring individuals toward lasting inner wholeness.',
                'color'       => '#14B8A6',
                'icon'        => 'sun',
                'is_featured' => false,
                'sort_order'  => 8,
            ],
        ];

        foreach ($services as $svc) {
            Service::updateOrCreate(['title' => $svc['title']], $svc);
        }
    }
}
