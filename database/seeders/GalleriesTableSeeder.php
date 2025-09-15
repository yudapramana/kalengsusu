<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GalleriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('galleries')->delete();
        
        \DB::table('galleries')->insert(array (
            0 => 
            array (
                'id_gallery' => 1,
                'created_at' => '2023-06-21 15:32:39',
                'updated_at' => '2023-06-21 15:40:16',
                'user_id' => 0,
                'image_url' => 'https://res.cloudinary.com/dezj1x6xp/image/upload/v1698299466/PandanViewMandeh/AF1QipPbUTeNjEbixXR5hd3ZD3tk1XME5u0PJbGLnUPI_s0_vv0w8g.jpg',
                'filter_tag' => 'Fasilitas',
                'alt' => 'kanwil_depan',
                'title' => 'Kanwil Tampak Depan',
                'slug' => NULL,
                'description' => 'Kantor Wilayah Kementerian Agama Tampak Depan',
                'url' => NULL,
                'type' => 'foto',
            ),
            1 => 
            array (
                'id_gallery' => 2,
                'created_at' => '2023-06-21 15:32:39',
                'updated_at' => '2023-06-21 15:40:16',
                'user_id' => 0,
                'image_url' => 'https://res.cloudinary.com/dezj1x6xp/image/upload/v1698301278/PandanViewMandeh/AF1QipPnL7w8drYOmwydU_wAw0kehH4l2_dYsvFmp7PQ_s0_iwjlyo.jpg',
                'filter_tag' => 'Fasilitas',
                'alt' => 'kanwil_belakang',
                'title' => 'Kanwil Tampak Belakang',
                'slug' => NULL,
                'description' => 'Kantor Wilayah Kementerian Agama Tampak Belakang',
                'url' => NULL,
                'type' => 'foto',
            ),
            2 => 
            array (
                'id_gallery' => 3,
                'created_at' => '2023-06-21 15:32:39',
                'updated_at' => '2023-06-21 15:40:16',
                'user_id' => 0,
                'image_url' => 'https://res.cloudinary.com/dezj1x6xp/image/upload/v1698301460/PandanViewMandeh/AF1QipPJb4rUS-R7njt4Q27YWTspJ10vyr578nIKd1go_s0_ubssbr.jpg',
                'filter_tag' => 'Fasilitas',
                'alt' => 'kanwil_samping',
                'title' => 'Kanwil Tampak Samping',
                'slug' => NULL,
                'description' => 'Kantor Wilayah Kementerian Agama Tampak Samping',
                'url' => NULL,
                'type' => 'foto',
            ),
            3 => 
            array (
                'id_gallery' => 4,
                'created_at' => '2023-10-27 08:50:33',
                'updated_at' => '2023-10-27 08:51:17',
                'user_id' => 0,
                'image_url' => 'https://res.cloudinary.com/dezj1x6xp/image/upload/v1698371387/PandanViewMandeh/maxresdefault_hn8rrl.jpg',
                'filter_tag' => 'Haji',
                'alt' => 'Haji',
                'title' => 'PDG 11 Tutup Pemulangan Jemaah Debarkasi',
                'slug' => NULL,
                'description' => 'PDG 11 Tutup Pemulangan Jemaah Debarkasi Antara #hajiramahlansia #hajiindonesia2023',
                'url' => 'https://www.youtube.com/watch?v=6e9J_IrXPmg',
                'type' => 'video',
            ),
        ));
        
        
    }
}