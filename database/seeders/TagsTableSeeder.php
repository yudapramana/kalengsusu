<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tags')->delete();
        
        \DB::table('tags')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'PPID',
                'slug' => 'ppid',
                'keywords' => '',
                'meta_desc' => '',
                'created_at' => '2023-07-10 12:16:25',
                'updated_at' => '2023-07-10 14:14:48',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Pengajuan Informasi',
                'slug' => 'pengajuan-informasi',
                'keywords' => '',
                'meta_desc' => '',
                'created_at' => '2023-07-10 12:17:09',
                'updated_at' => '2023-07-10 12:17:09',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Rapat Kerja',
                'slug' => 'rapat-kerja',
                'keywords' => '',
                'meta_desc' => '',
                'created_at' => '2023-07-10 15:23:33',
                'updated_at' => '2023-07-10 15:23:33',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'Kegiatan',
                'slug' => 'kegiatan',
                'keywords' => '',
                'meta_desc' => '',
                'created_at' => '2023-07-11 11:34:42',
                'updated_at' => '2023-07-11 11:34:42',
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'Monitoring dan Evaluasi',
                'slug' => 'monitoring-dan-evaluasi',
                'keywords' => '',
                'meta_desc' => '',
                'created_at' => '2023-07-13 08:49:30',
                'updated_at' => '2023-07-13 08:49:30',
            ),
            5 => 
            array (
                'id' => 7,
                'name' => 'Informasi Instansi',
                'slug' => 'informasi-instansi',
                'keywords' => 'Informasi Instansi',
                'meta_desc' => 'Informasi Instansi',
                'created_at' => '2023-08-30 08:54:17',
                'updated_at' => '2023-08-30 08:54:17',
            ),
        ));
        
        
    }
}