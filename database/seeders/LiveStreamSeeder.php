<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LiveStream;
use Illuminate\Support\Carbon;

class LiveStreamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LiveStream::create([
            'title' => 'Test', 
            'scheduled_at' => Carbon::now(),
            'scheduled_end' => Carbon::now()->nextWeekday(),
            'youtube_embed_url' => 'https://www.youtube.com/embed/qA7_9fcCbZ8'
        ]);
    }
}
