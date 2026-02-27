<?php

namespace Database\Seeders;

use App\Models\Profile;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('profiles')->insert([
            [
                'name' => 'Sekanca Media Digital',
                'summary' => 'Software House – Digital Solution for Modern Business',
                'address' => 'Ruko Taman Surya 3 Blok J 1 / 33 C-D Jakarta Barat 11830',
                'email' => 'cs@sekanca.com',
                'phone' => '6285755667699',
                'map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d294.8479207734764!2d106.71725265389503!3d-6.132723426647687!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a03d4a454ba31%3A0xab9e12a7f77639e4!2sSekanca%20Media%20Digital!5e0!3m2!1sid!2sid!4v1771195616250!5m2!1sid!2sid" width="250" height="100" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'website' => 'https://sekanca.com',
                'logo' => 'logo.webp',
                'description' => 'Sekanca Media Digital is a software house in West Jakarta that provides web development services, applications, and digital business solutions',
                'keyword' => 'Sekanca Media Digital is a software house in West Jakarta that provides web development services, applications, and digital business solutions',
            ],
        ]);
    }
}
