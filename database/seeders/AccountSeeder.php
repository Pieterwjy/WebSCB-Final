<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Account::create([
            // 'title' => 'Live Stream 1',
            // 'scheduled_at' => now()->addDays(1),
            // 'youtube_embed_url' => 'https://www.youtube.com/embed/your-youtube-video-id',
            // 'status' => 'scheduled',
            'name' =>'Pendeta',
            'email' =>'pendeta@pendeta.com',
            'phone' =>'08123456789',
            'role' =>'pendeta',
            'password' => '12345678'
        ]);

        Account::create([
            'name' =>'Admin',
            'email' =>'admin@admin.com',
            'phone' =>'08123456789',
            'role' =>'admin',
            'password' => '12345678'
        ]);

        Account::create([
            'name' =>'Multimedia',
            'email' =>'multimedia@multimedia.com',
            'phone' =>'08123456789',
            'role' =>'multimedia',
            'password' => '12345678'
        ]);
    }
}
