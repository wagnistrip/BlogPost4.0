<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogLike;
use App\Models\Blog;
use App\Models\User;
class BlogLikeSeeder extends Seeder
{
    public function run()
    {
        // Fetch all blog IDs and user IDs
        $blogIds = Blog::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        if (empty($blogIds) || empty($userIds)) {
            $this->command->warn('No blogs or users found. Skipping BlogLike seeding.');
            return;
        }

        foreach ($blogIds as $blogId) {
            $likeCount = rand(1, 10);

            for ($j = 0; $j < $likeCount; $j++) {
                BlogLike::create([
                    'blog_id' => $blogId,
                    'user_id' => $userIds[array_rand($userIds)], 
                ]);
            }
        }
    }
}
