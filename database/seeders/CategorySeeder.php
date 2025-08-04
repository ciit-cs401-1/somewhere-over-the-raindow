<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'description' => 'Articles about technology, programming, and software development.'
            ],
            [
                'name' => 'Travel',
                'description' => 'Travel stories, tips, and destination guides.'
            ],
            [
                'name' => 'Food',
                'description' => 'Recipes, cooking tips, and food reviews.'
            ],
            [
                'name' => 'Lifestyle',
                'description' => 'Personal development, health, and lifestyle tips.'
            ],
            [
                'name' => 'Business',
                'description' => 'Business insights, entrepreneurship, and career advice.'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
