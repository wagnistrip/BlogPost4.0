<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Category;

class BlogSeeder extends Seeder
{
    public function run()
    {

        $faker      = Faker::create();
        $users      = User::all();
        $categories = Category::all();

        if ($users->isEmpty() || $categories->isEmpty()) {
            return;
        }

        foreach (range(1, 10) as $index) {
            DB::table('blogs')->insert([
                'user_id'           => $users->random()->id,
                'category_id'       => $categories->random()->id,
                'title'             => $faker->sentence,
                'sub_title'         => $faker->sentence,
                'short_description' => $faker->paragraph,
                'description'       => $faker->text,
                'slug'              => Str::slug($faker->sentence),
                'excerpt'           => $faker->paragraph,
                'tags'              => json_encode($faker->words(5)),
                'status'            => $faker->boolean,
                'view_count'        => $faker->numberBetween(0, 1000),
                'comment_count'     => $faker->numberBetween(0, 500),
                'seo_title'         => $faker->sentence,
                'seo_description'   => $faker->paragraph,
                'seo_keywords'      => $faker->words(5, true),
                'like_count'        => $faker->numberBetween(0, 100),
                'share_count'       => $faker->numberBetween(0, 100),
                'published_at'      => $faker->dateTimeBetween('-1 month', 'now'),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}
