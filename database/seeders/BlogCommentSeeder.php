<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogComment;
use Faker\Factory as Faker;
use App\Models\Blog;
use App\Models\User;
class BlogCommentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Select a random existing blog and user
        $blog = Blog::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();

        if ($blog && $user) {
            BlogComment::create([
                'blog_id' => $blog->id,
                'user_id' => $user->id,
                'comment' => $faker->sentence(),
            ]);
        }
    }
}
