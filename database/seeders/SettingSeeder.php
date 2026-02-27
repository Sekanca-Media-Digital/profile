<?php

namespace Database\Seeders;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('settings')->insert([
            [
                'name' => 'number of columns on the About page',
                'key' => 'about',
                'value' => '3',
            ],
            [
                'name' => 'number of columns on the Product page',
                'key' => 'product',
                'value' => '3',
            ],
            [
                'name' => 'number of columns on the Services page',
                'key' => 'services',
                'value' => '9',
            ],
            [
                'name' => 'number of columns on the Testimonies page',
                'key' => 'testimony',
                'value' => '3',
            ],
        ]);
    }
}
