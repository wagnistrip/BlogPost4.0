<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogShare;
use App\Models\Blog;
use App\Models\User;

class BlogShareSeeder extends Seeder
{
    public function run()
    {
        // Fetch all blog IDs and user IDs
        $blogIds = Blog::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

    
        if (empty($blogIds) || empty($userIds)) {
            $this->command->warn('No blogs or users found. Skipping BlogShare seeding.');
            return;
        }

        foreach ($blogIds as $blogId) {

            $shareCount = rand(1, 5);

            for ($j = 0; $j < $shareCount; $j++) {
                BlogShare::create([
                    'blog_id' => $blogId,
                    'user_id' => $userIds[array_rand($userIds)],
                ]);
            }
        }
    }
}
