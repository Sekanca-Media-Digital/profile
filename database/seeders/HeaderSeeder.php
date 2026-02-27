<?php

namespace Database\Seeders;

use App\Models\Header;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('headers')->insert([
            [
                'name' => 'Sekanca Media Digital',
                'summary' => 'Software House – Digital Solution for Modern Business',
                'image' => 'landing/bg-mockup-theme-1.png',
                'status' => 'active',
                'type' => 'home',
            ],
            [
                'name' => 'Why Us?',
                'summary' => 'Sekanca Media Digital is a software house focused on developing web applications and digital systems for businesses.',
                'image' => '',
                'status' => 'active',
                'type' => 'about',
            ],
            [
                'name' => 'Complete Combo',
                'summary' => 'Wheather you are developer or designer, Sekanca serve the need of all - No matter you are novice or expert',
                'image' => '',
                'status' => 'active',
                'type' => 'product',
            ],
            [
                'name' => 'Create Beautiful Yet Powerful web apps',
                'summary' => 'Create your powerful project using powerful design system of Sekanca.',
                'image' => '',
                'status' => 'active',
                'type' => 'service',
            ],
            [
                'name' => 'Customers Voice',
                'summary' => 'We have proven records in Dashboard development with an average 4.9/5 ratings. We are glad to show such a warm reviews from our loyal customers.',
                'image' => '',
                'status' => 'active',
                'type' => 'testimony',
            ],
            [
                'name' => 'Send us your message',
                'summary' => 'The starting point for your next project based on easy-to-customize Material-UI © helps you build apps faster and better.',
                'image' => '',
                'status' => 'active',
                'type' => 'contact',
            ]
        ]);
    }
}
