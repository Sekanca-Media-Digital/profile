<?php

namespace Database\Seeders;

use App\Models\Info;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('infos')->insert([
            [
                'name' => 'Professional Design',
                'summary' => 'Sekanca has fully professional grade user interface for any kind of backend project.',
                'image' => '',
                'type' => 'about',
                'icon' => 'layout',
                'status' => 'active',
            ],
            [
                'name' => 'Flexible Solution',
                'summary' => 'Highly flexible to work with any kind of project, from small to large scale projects.',
                'image' => '',
                'type' => 'about', //about, product, service
                'icon' => 'devices',
                'status' => 'active',
            ],
            [
                'name' => 'Effective Documentation',
                'summary' => 'Comprehensive and well-organized documentation to help developers get started quickly.',
                'image' => '',
                'type' => 'about', //about, product, service
                'icon' => 'book',
                'status' => 'active',
            ],
            [
                'name' => 'Design Source Files',
                'summary' => 'All design source files are included in the package for easy customization.',
                'image' => 'landing/img-demo1.jpg',
                'type' => 'product', //about, product, service
                'icon' => 'folder',
                'status' => 'active',
            ],
            [
                'name' => 'Components and Pages',
                'summary' => 'A wide variety of pre-built components and pages to accelerate development.',
                'image' => 'landing/img-demo2.jpg',
                'type' => 'product', //about, product, service
                'icon' => 'layers',
                'status' => 'active',
            ],
            [
                'name' => 'Documentation and Support',
                'summary' => 'Comprehensive documentation and dedicated support to help you make the most of our product.',
                'image' => 'http://localhost:8081/public/assets/images/landing/img-demo2.jpg',
                'type' => 'product', //about, product, service
                'icon' => 'support',
                'status' => 'active',
            ],
            [
                'name' => 'Auth Methods : JWT, Auth0, Firebase',
                'summary' => '',
                'image' => '',
                'type' => 'service', //about, product, service
                'icon' => 'circle-check',
                'status' => 'active',
            ],
            [
                'name' => 'Code Splitting',
                'summary' => '',
                'image' => '',
                'type' => 'service', //about, product, service
                'icon' => 'circle-check',
                'status' => 'active',
            ],
            [
                'name' => 'RTL Support',
                'summary' => '',
                'image' => '',
                'type' => 'service', //about, product, service
                'icon' => 'circle-check',
                'status' => 'active',
            ],
            [
                'name' => 'Internationalization Support',
                'summary' => '',
                'image' => '',
                'type' => 'service', //about, product, service
                'icon' => 'circle-check',
                'status' => 'active',
            ],
            [
                'name' => 'React Hooks',
                'summary' => '',
                'image' => '',
                'type' => 'service', //about, product, service
                'icon' => 'circle-check',
                'status' => 'active',
            ],
            [
                'name' => 'Light/Dark, Semi Dark Support',
                'summary' => '',
                'image' => '',
                'type' => 'service', //about, product, service
                'icon' => 'circle-check',
                'status' => 'active',
            ],
            [
                'name' => 'Mock API',
                'summary' => '',
                'image' => '',
                'type' => 'service', //about, product, service
                'icon' => 'circle-check',
                'status' => 'active',
            ],
            [
                'name' => 'Google Fonts',
                'summary' => '',
                'image' => '',
                'type' => 'service', //about, product, service
                'icon' => 'circle-check',
                'status' => 'active',
            ],
            [
                'name' => 'Prettier Code Style',
                'summary' => '',
                'image' => '',
                'type' => 'service', //about, product, service
                'icon' => 'circle-check',
                'status' => 'active',
            ],
        ]);
    }
}
