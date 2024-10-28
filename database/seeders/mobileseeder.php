<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class mobileseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mobileproducts')->insert([

            'Brand'=>'vivo',
            'Model'=>'Y18e (4+64)',
            'Version'=>'Funtouch OS 14',
            'Processor'=>'Helio G85',
            'RAM'=>'4 GB',
            'ROM'=>'64 GB',
            'Color'=>'Space Black/Gem Green',
            'Display_Size'=>'6.56"',
            'Camera_f'=>'13 MP + 0.08 MP',
            'Camera_b'=>'5 MP',
            'Battery'=>'5000 mAh',
            'Price'=>'10000',
            'Gallery'=>'public\images\vivoy.jpg',

        ]);

        DB::table('mobileproducts')->insert([

            'Brand'=>'Apple',
            'Model'=>'iphone 13 (8+128)',
            'Version'=>'Funtouch OS 14',
            'Processor'=>'Helio G85',
            'RAM'=>'8 GB',
            'ROM'=>'128 GB',
            'Color'=>'Space Black/Gem Green',
            'Display_Size'=>'6.56"',
            'Camera_f'=>'13 MP + 0.08 MP',
            'Camera_b'=>'5 MP',
            'Battery'=>'5000 mAh',
            'Price'=>'20000',
            'Gallery'=>'public\images\mob.jpg',

        ]);
    }
}
