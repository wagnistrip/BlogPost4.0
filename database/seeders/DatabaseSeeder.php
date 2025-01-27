<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = Admin::create( [
            'name'                             => 'Akhilesh',
            'lastName'                         => 'Sahani',
            'email'                            => 'developer@wagnistrip.com',
            'phone'                            => '+6587767705',
            'password'                         => Hash::make('password'),
            'role'                             => 'Admin',
            'gender'                           => 'Male',
            'plen_pass'                        => 'password',
            'status'                           => true,
        ]);
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            BlogSeeder::class,
            BlogCommentSeeder::class,
            BlogImageSeeder::class,
            BlogLikeSeeder::class,
            BlogShareSeeder::class,
        ]);
    }
}
