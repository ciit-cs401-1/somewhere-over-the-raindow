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
            'Laravel',
            'PHP',
            'JavaScript',
            'Vue.js',
            'React',
            'CSS',
            'HTML',
            'Database',
            'API',
            'Web Development',
            'Mobile Development',
            'UI/UX',
            'Testing',
            'Deployment',
            'Docker',
            'Git',
            'Agile',
            'Startup',
            'Marketing',
            'SEO'
        ];

        foreach ($tags as $tagName) {
            Tag::create(['name' => $tagName]);
        }
    }
}
