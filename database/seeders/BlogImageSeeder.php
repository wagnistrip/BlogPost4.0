<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogImage;
use Faker\Factory as Faker;
use App\Models\Blog;

class BlogImageSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Fetch all blog IDs
        $blogIds = Blog::pluck('id')->toArray();

        foreach ($blogIds as $blogId) {
            // Generate a random number of images per blog (e.g., 1-5)
            $imageCount = rand(1, 5);

            for ($j = 0; $j < $imageCount; $j++) {
                BlogImage::create([
                    'blog_id'    => $blogId,
                    'image_path' => $faker->filePath(), // Random file path
                    'image_name' => $faker->word() . '.jpg', // Random image name
                ]);
            }
        }
    }
}
