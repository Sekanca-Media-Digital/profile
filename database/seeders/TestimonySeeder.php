<?php

namespace Database\Seeders;

use App\Models\Testimony;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('testimonies')->insert([
            [
                'name' => 'Code Quality',
                'summary' => 'Fantastic design and good code quality. Its a great starting point for any new project. They provide plenty of pre made components, page views, and authentication options. Definitely the best Ive found for Material UI in Typescript.',
                'customer' => 'Felipe F.',
                'rate' => 5,
                'status' => 'active',
            ],
            [
                'name' => 'Code Quality',
                'summary' => 'Great template. Very well written code and good structure. Very customizable and tons of nice components. Good documentation. Team is very responsive too.',
                'customer' => 'Besart M',
                'rate' => 4,
                'status' => 'active',
            ],
            [
                'name' => 'Customizability',
                'summary' => 'Excellent design, you can use in a new project or include in your current project. Multiple components for any use. Good code quality. Great customer service and support.',
                'customer' => 'Rodrigo J.',
                'rate' => 4,
                'status' => 'active',
            ],
            [
                'name' => 'Design Quality',
                'summary' => 'There is no mistake, great design and organized code, thank you ...',
                'customer' => 'Yang Z.',
                'rate' => 4,
                'status' => 'active',
            ],
            [
                'name' => 'Performance',
                'summary' => 'The design is very good, the code is clean and well organized, and the performance is very good. I have been using it for a few weeks now and I am very happy with it.',
                'customer' => 'Sergio M.',
                'rate' => 5,
                'status' => 'active',
            ],
            [
                'name' => 'Design and Code Quality',
                'summary' => 'Great design and good code quality. Its a great starting point for any new project. They provide plenty of pre made components, page views, and authentication options. Definitely the best Ive found for Material UI in Typescript.',
                'customer' => 'Xavier M.',
                'rate' => 5,
                'status' => 'active',
            ],
        ]);
    }
}
