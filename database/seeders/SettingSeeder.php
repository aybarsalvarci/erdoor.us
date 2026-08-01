<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // DB facade'inin eklendiğinden emin olun

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->updateOrInsert(
            ['id' => 1], // Koşul (Bu ID varsa güncelle)
            [
                'title' => 'Erdoor - Modern Door Systems',
                'description' => 'Explore our high-quality door systems and professional solutions.',
                'keywords' => 'doors, wood door, steel door, erdoor, interior doors',
                'contact_email' => 'contact@erdoor.us',
                'sender_email' => 'no-reply@erdoor.us',
                'notification_email' => 'admin@erdoor.us',
                'phone' => '+1 305 413 3603',
                'logo' => 'front/assets/images/logo.png',
                'favicon' => 'front/assets/images/favicon.ico',
                'footer_content' => 'Leading brand in modern and secure door manufacturing solutions worldwide.',
                'footer_copyright' => '© 2026 Erdoor. All rights reserved.',
                'footer_address' => 'Miami, Florida, USA',
                'facebook' => 'https://facebook.com/erdoor',
                'twitter' => 'https://twitter.com/erdoor',
                'instagram' => 'https://instagram.com/erdoor',
                'linkedin' => 'https://linkedin.com/company/erdoor',
                'youtube' => 'https://youtube.com/@erdoor',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
