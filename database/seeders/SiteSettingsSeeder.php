<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'about_bio_1'      => 'Dr. Mrs. Anthonia Yemisi Soje is a Nigerian medical practitioner, board-certified psycho-trauma therapist, and a thought leader at the intersection of faith and psychology. As Founder & CEO of Fosterheirs Mental Health Consultancy and a leading voice at the intersection of Christian faith and mental health, she has built her practice on a single conviction: that lasting healing must honour the whole person — mind, body, and soul. Drawing on medical expertise, psychological depth, and spiritual wisdom, she walks alongside individuals and families to restore hope where it has been most severely tested.',
            'about_bio_2'      => 'Beyond the therapy room, Dr. Soje is a sought-after speaker and published author who carries this integrated message to corporate boardrooms, church pulpits, conference halls, and seminar stages — speaking with authority and compassion on addiction, trauma, ADHD, marriage, emotional resilience, and the often-overlooked role of faith in mental wellness.',
            'about_quote'      => 'God designed the mind just as He designed the soul — and true healing must honour both. This is why faith and science must walk together.',
            'stat_books'       => '8',
            'stat_lives'       => '200',
            'stat_marriages'   => '50',
            'stat_addicts'     => '100',
            'social_facebook'  => '',
            'social_instagram' => '',
            'social_twitter'   => '',
            'social_linkedin'  => '',
            'contact_phone'    => '',
            'contact_email'    => '',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        /* Seed sample approved testimonials */
        $testimonials = [
            [
                'name'    => 'Anonymous',
                'service' => 'Addiction Recovery',
                'rating'  => 5,
                'content' => 'After years of battling addiction alone, Dr. Soje\'s approach at Fosterheirs gave me something no other program had — a reason to believe recovery was actually possible. Today I am three years clean and my family is whole again.',
                'status'  => 'approved',
            ],
            [
                'name'    => 'Mrs. T. Okonkwo',
                'service' => 'Marriage Counselling',
                'rating'  => 5,
                'content' => 'My husband and I were on the verge of divorce. Two months of marriage counseling with Dr. Soje completely transformed our communication and helped us rediscover our love for each other. She is truly gifted.',
                'status'  => 'approved',
            ],
            [
                'name'    => 'B. Adeyemi',
                'service' => 'Trauma Therapy',
                'rating'  => 5,
                'content' => 'Dr. Soje\'s trauma therapy sessions were life-altering. She has a rare ability to make you feel truly seen and heard. The healing I experienced goes beyond what I thought was possible after everything I went through.',
                'status'  => 'approved',
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(['name' => $t['name'], 'service' => $t['service']], $t);
        }
    }
}
