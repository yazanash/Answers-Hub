<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class BotUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bot = User::firstOrCreate(
            ['email' => 'bot@answers-hub.com'],
            [
                'name' => 'AnswersHUB-Bot',
                'password' => bcrypt('secure-password-123'),
                'email_verified_at' => now(),
            ]
        );

        // إذا عندك جدول profiles مرتبط بـ user
        if (method_exists($bot, 'profile') && !$bot->profile) {
            $bot->profile()->create([
                'bio' => 'I am the AnswersHUB Assistant Bot!',
                'photo' => 'bot-img.jpg', 
                'name' => 'AnswersHUB-Bot',
                'gender' => '1',
            ]);
        }
    }
}
