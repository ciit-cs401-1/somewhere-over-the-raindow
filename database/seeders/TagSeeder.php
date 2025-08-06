<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            // Technology
            'Laravel', 'PHP', 'JavaScript', 'Web Development', 'UI/UX',

            // Business
            'Business', 'Startup', 'Marketing', 'SEO', 'Productivity', 'Finance', 'Career', 'Leadership',

            // Lifestyle
            'Lifestyle', 'Travel', 'Health', 'Wellness', 'Food', 'Fashion', 'DIY'
        ];

        foreach ($tags as $tagName) {
            Tag::create(['name' => $tagName]);
        }
    }
}
