<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActivitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('activities')->delete();
        
        \DB::table('activities')->insert(array (
            0 => 
            array (
                'id_activity' => 1,
                'created_at' => '2023-09-04 13:06:47',
                'updated_at' => '2023-09-04 13:06:47',
                'cover_image_url' => 'https://res.cloudinary.com/dezj1x6xp/image/upload/v1693807606/PandanViewMandeh/Pokja_K2MI_iilt33.jpg',
                'title_id' => NULL,
                'title_en' => NULL,
                'date' => '2023-08-29',
                'name' => 'Narasumber Dalam Acara POKJA K2MI',
                'description' => 'Kakan Kemenag Kab. Pesisir Selatan, H. Abrar Munanda, M. Ag Menjadi Narasumber Dalam Acara POKJA K2MI Kab. Pesisir Selatan Tahun 2023 Dalam Tema Moderasi Beragama. Selasa/29 Agustus 2023 Di Aula Raudhah KanKemenag Kab. Pesisir Selatan',
                'next_url' => NULL,
                'slug' => NULL,
            ),
            1 => 
            array (
                'id_activity' => 2,
                'created_at' => '2023-09-04 13:08:21',
                'updated_at' => '2023-09-04 13:08:21',
                'cover_image_url' => 'https://res.cloudinary.com/dezj1x6xp/image/upload/v1693807700/PandanViewMandeh/sk_pensiun_bbuzwp.jpg',
                'title_id' => NULL,
                'title_en' => NULL,
                'date' => '2023-08-29',
                'name' => 'Penyerahan Piagam Penghargaan ASN SK Pensiuan',
                'description' => 'Penyerahan Piagam Penghargaan ASN Pensiunan kepada Afriyasni',
                'next_url' => NULL,
                'slug' => NULL,
            ),
        ));
        
        
    }
}