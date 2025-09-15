<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Utama',
                'slug' => 'utama',
                'keywords' => '',
                'meta_desc' => '',
                'created_at' => '2023-07-10 12:14:14',
                'updated_at' => '2023-07-10 12:14:14',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Daerah',
                'slug' => 'daerah',
                'keywords' => '',
                'meta_desc' => '',
                'created_at' => '2023-07-10 12:14:14',
                'updated_at' => '2023-07-10 12:14:14',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Nasional',
                'slug' => 'nasional',
                'keywords' => '',
                'meta_desc' => '',
                'created_at' => '2023-07-10 12:14:34',
                'updated_at' => '2023-07-10 12:14:34',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Internasional',
                'slug' => 'internasional',
                'keywords' => '',
                'meta_desc' => '',
                'created_at' => '2023-07-10 12:14:34',
                'updated_at' => '2023-07-10 12:14:34',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Pers Rilis',
                'slug' => 'pers-rilis',
                'keywords' => '',
                'meta_desc' => '',
                'created_at' => '2023-07-10 12:15:30',
                'updated_at' => '2023-07-10 12:15:30',
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'Opini',
                'slug' => 'opini',
                'keywords' => '',
                'meta_desc' => '',
                'created_at' => '2023-07-11 11:34:28',
                'updated_at' => '2023-07-11 11:34:28',
            ),
            6 => 
            array (
                'id' => 7,
                'title' => 'Artikel',
                'slug' => 'artikel',
                'keywords' => 'Artikel',
                'meta_desc' => 'Artikel',
                'created_at' => '2023-08-30 10:50:24',
                'updated_at' => '2023-08-30 10:50:24',
            ),
            7 => 
            array (
                'id' => 8,
                'title' => 'Wawancara',
                'slug' => 'wawancara',
                'keywords' => 'Wawancara',
                'meta_desc' => 'Wawancara',
                'created_at' => '2023-08-30 23:13:51',
                'updated_at' => '2023-08-30 23:13:51',
            ),
            8 => 
            array (
                'id' => 9,
                'title' => 'Pojok Kakanwil',
                'slug' => 'pojok-kakanwil',
                'keywords' => 'Pojok Kakanwil',
                'meta_desc' => 'Pojok Kakanwil',
                'created_at' => '2023-08-31 19:35:22',
                'updated_at' => '2023-08-31 19:35:22',
            ),
        ));
        
        
    }
}