<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        for ($i = 0; $i < 100; $i++){
            DB::table('pieces')->insert([
                'title' => Str::random(10),
                'author' => Str::random(10),
                'year' => rand(0, 9999),
                'duration' => rand(0, 999),
                'type' => Str::random(5),
                'user_id' => 1,
                'file_name' => Str::random(12)
            ]);
        }
        
    }
}
