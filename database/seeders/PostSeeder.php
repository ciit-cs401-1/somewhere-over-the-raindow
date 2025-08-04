<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first user (or create one if none exists)
        $user = User::first() ?? User::factory()->create();
        
        // Get categories and tags
        $technologyCategory = Category::where('name', 'Technology')->first();
        $travelCategory = Category::where('name', 'Travel')->first();
        $foodCategory = Category::where('name', 'Food')->first();
        
        $laravelTag = Tag::where('name', 'Laravel')->first();
        $phpTag = Tag::where('name', 'PHP')->first();
        $javascriptTag = Tag::where('name', 'JavaScript')->first();
        $webDevTag = Tag::where('name', 'Web Development')->first();

        $posts = [
            [
                'title' => 'Getting Started with Laravel',
                'content' => 'Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as authentication, routing, sessions, and caching.',
                'excerpt' => 'Learn the basics of Laravel framework and start building web applications.',
                'category_id' => $technologyCategory->id,
                'status' => 'published',
                'tags' => [$laravelTag->id, $phpTag->id, $webDevTag->id]
            ],
            [
                'title' => 'Modern JavaScript Development',
                'content' => 'JavaScript has evolved significantly over the years. From a simple scripting language to a powerful tool for building complex applications. Modern JavaScript includes features like ES6 modules, async/await, and powerful frameworks like React and Vue.js.',
                'excerpt' => 'Explore modern JavaScript features and best practices for web development.',
                'category_id' => $technologyCategory->id,
                'status' => 'published',
                'tags' => [$javascriptTag->id, $webDevTag->id]
            ],
            [
                'title' => 'Best Travel Destinations 2024',
                'content' => 'Discover the most amazing travel destinations for 2024. From pristine beaches to bustling cities, there\'s something for every type of traveler. Plan your next adventure with our comprehensive guide to the best places to visit.',
                'excerpt' => 'Explore the top travel destinations for your next adventure.',
                'category_id' => $travelCategory->id,
                'status' => 'published',
                'tags' => []
            ],
            [
                'title' => 'Quick and Easy Recipes',
                'content' => 'Cooking doesn\'t have to be complicated. These quick and easy recipes will help you prepare delicious meals in no time. Perfect for busy weeknights or when you want something homemade but don\'t have hours to spend in the kitchen.',
                'excerpt' => 'Simple recipes for delicious homemade meals.',
                'category_id' => $foodCategory->id,
                'status' => 'published',
                'tags' => []
            ]
        ];

        foreach ($posts as $postData) {
            $tags = $postData['tags'];
            unset($postData['tags']);
            
            $post = Post::create([
                'title' => $postData['title'],
                'content' => $postData['content'],
                'excerpt' => $postData['excerpt'],
                'category_id' => $postData['category_id'],
                'status' => $postData['status'],
                'user_id' => $user->id
            ]);

            if (!empty($tags)) {
                $post->tags()->attach($tags);
            }
        }
    }
}
