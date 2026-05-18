<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title'          => 'Echoes of Eden',
                'description'    => 'Building healthy homes and nurturing meaningful relationships rooted in love and purpose.',
                'category'       => 'Marriage & Relationships',
                'cover_gradient' => 'bg-b1',
                'icon'           => 'book',
                'sort_order'     => 1,
            ],
            [
                'title'          => 'The Addiction Compass',
                'description'    => 'A guide to understanding addiction, navigating recovery, and building lasting sobriety.',
                'category'       => 'Addiction Recovery',
                'cover_gradient' => 'bg-b2',
                'icon'           => 'navigation',
                'sort_order'     => 2,
            ],
            [
                'title'          => 'Unshackled',
                'description'    => 'Daily faith anchors for those in recovery — breaking free from addiction\'s chains through devotion.',
                'category'       => 'Devotional',
                'cover_gradient' => 'bg-b3',
                'icon'           => 'unlock',
                'sort_order'     => 3,
            ],
            [
                'title'          => 'Unmasking You',
                'description'    => 'A guide to personality disorders — understanding human behavior and emotional patterns.',
                'category'       => 'Psychology',
                'cover_gradient' => 'bg-b4',
                'icon'           => 'eye',
                'sort_order'     => 4,
            ],
            [
                'title'          => 'Anchored',
                'description'    => 'Exploring identity, self-worth, and faith-based encouragement for those searching for solid ground.',
                'category'       => 'Identity & Faith',
                'cover_gradient' => 'bg-b5',
                'icon'           => 'anchor',
                'sort_order'     => 5,
            ],
            [
                'title'          => 'Sanctuary',
                'description'    => 'A journey through trauma healing, psychological restoration, and the discovery of spiritual wholeness.',
                'category'       => 'Trauma Healing',
                'cover_gradient' => 'bg-b6',
                'icon'           => 'shield',
                'sort_order'     => 6,
            ],
            [
                'title'          => 'The Fourfold Path to Freedom',
                'description'    => 'A holistic recovery model combining medical, psychological, social, and spiritual healing.',
                'category'       => 'Addiction Recovery',
                'cover_gradient' => 'bg-b7',
                'icon'           => 'key',
                'sort_order'     => 7,
            ],
            [
                'title'          => 'Feelings and Faith',
                'description'    => 'Helping parents guide children to regulate emotions through principles of faith and intentional parenting.',
                'category'       => 'Parenting',
                'cover_gradient' => 'bg-b8',
                'icon'           => 'smile',
                'sort_order'     => 8,
            ],
        ];

        foreach ($books as $book) {
            Book::updateOrCreate(['title' => $book['title']], $book);
        }
    }
}
