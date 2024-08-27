<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'title' => 'Test',
            'excerpt' => 'test',
            'body' => 'test 123',
            'published_at' => Carbon::now(),
        ]);
            
       
    }
}
