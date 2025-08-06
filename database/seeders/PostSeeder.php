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
        $lifestyleCategory = Category::where('name', 'Lifestyle')->first();
        $businessCategory = Category::where('name', 'Business')->first();
        
        // Fetching tags by name to get their IDs
        $laravelTag = Tag::where('name', 'Laravel')->first();
        $phpTag = Tag::where('name', 'PHP')->first();
        $javascriptTag = Tag::where('name', 'JavaScript')->first();
        $webDevTag = Tag::where('name', 'Web Development')->first();
        $businessTag = Tag::where('name', 'Business')->first();
        $startupTag = Tag::where('name', 'Startup')->first();
        $productivityTag = Tag::where('name', 'Productivity')->first();
        $careerTag = Tag::where('name', 'Career')->first();
        $lifestyleTag = Tag::where('name', 'Lifestyle')->first();
        $travelTag = Tag::where('name', 'Travel')->first();
        $healthTag = Tag::where('name', 'Health')->first();
        $foodTag = Tag::where('name', 'Food')->first();
        $leadershipTag = Tag::where('name', 'Leadership')->first();
        $wellnessTag = Tag::where('name', 'Wellness')->first();
        $diyTag = Tag::where('name', 'DIY')->first();

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
                'tags' => [$travelTag->id, $lifestyleTag->id]
            ],
            [
                'title' => 'Quick and Easy Recipes',
                'content' => 'Cooking doesn\'t have to be complicated. These quick and easy recipes will help you prepare delicious meals in no time. Perfect for busy weeknights or when you want something homemade but don\'t have hours to spend in the kitchen.',
                'excerpt' => 'Simple recipes for delicious homemade meals.',
                'category_id' => $foodCategory->id,
                'status' => 'published',
                'tags' => [$foodTag->id, $healthTag->id, $lifestyleTag->id]
            ],
            [
                'title' => '10 Tips for a Healthier Lifestyle',
                'content' => 'Living a healthier lifestyle doesn\'t have to be hard. With a few simple changes to your daily routine, you can improve your physical and mental well-being. This guide provides ten actionable tips to get you started on your journey to a healthier you.',
                'excerpt' => 'Discover ten simple tips to improve your daily health and well-being.',
                'category_id' => $lifestyleCategory->id,
                'status' => 'published',
                'tags' => [$healthTag->id, $lifestyleTag->id, $productivityTag->id]
            ],
            [
                'title' => 'The Future of Remote Work',
                'content' => 'Remote work is here to stay. This article explores the trends shaping the future of remote work, the benefits and challenges for both employers and employees, and how companies can build a thriving remote culture. Prepare your business for the new era of work.',
                'excerpt' => 'An in-depth look at the trends and strategies shaping the future of remote work.',
                'category_id' => $businessCategory->id,
                'status' => 'published',
                'tags' => [$businessTag->id, $careerTag->id, $productivityTag->id, $startupTag->id]
            ],
            [
                'title' => 'Mastering the Art of Negotiation',
                'content' => 'Negotiation is a key skill in both business and life. This guide covers the fundamental principles of effective negotiation, from preparation to closing the deal. Learn how to create win-win situations and achieve your goals with confidence.',
                'excerpt' => 'Learn the essential skills for successful negotiation in any situation.',
                'category_id' => $businessCategory->id,
                'status' => 'published',
                'tags' => [$businessTag->id, $careerTag->id, $leadershipTag->id, $productivityTag->id]
            ],
            [
                'title' => 'A Guide to Minimalist Living',
                'content' => 'Minimalism is about more than just decluttering; it\'s a mindset that can lead to a more intentional and fulfilling life. This guide explores the benefits of minimalism and provides practical steps to help you simplify your space, finances, and daily routines.',
                'excerpt' => 'Discover how to embrace minimalism for a simpler, more intentional life.',
                'category_id' => $lifestyleCategory->id,
                'status' => 'published',
                'tags' => [$lifestyleTag->id, $healthTag->id, $wellnessTag->id, $diyTag->id]
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
