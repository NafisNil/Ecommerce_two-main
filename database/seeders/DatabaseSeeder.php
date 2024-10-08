<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call(UsersTableSeeder::class);
         \App\Models\User::factory(40)->create();
         \App\Models\Category::factory(20)->create();
         \App\Models\Brand::factory(10)->create();
         \App\Models\Product::factory(40)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
