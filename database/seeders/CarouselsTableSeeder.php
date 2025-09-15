<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CarouselsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('carousels')->delete();
        
        \DB::table('carousels')->insert(array (
            0 => 
            array (
                'id_carousel' => 1,
                'created_at' => '2023-07-04 19:34:25',
                'updated_at' => '2023-10-26 12:51:11',
                'image_url' => 'https://res.cloudinary.com/dezj1x6xp/image/upload/v1698299466/PandanViewMandeh/AF1QipPbUTeNjEbixXR5hd3ZD3tk1XME5u0PJbGLnUPI_s0_vv0w8g.jpg',
                'title' => 'Kantor Wilayah Kementerian Agama Prov. Sumatera Barat',
                'active' => 'yes',
            ),
            1 => 
            array (
                'id_carousel' => 2,
                'created_at' => '2023-07-04 19:38:03',
                'updated_at' => '2023-10-26 13:21:31',
                'image_url' => 'https://res.cloudinary.com/dezj1x6xp/image/upload/v1698301278/PandanViewMandeh/AF1QipPnL7w8drYOmwydU_wAw0kehH4l2_dYsvFmp7PQ_s0_iwjlyo.jpg',
                'title' => 'Kanwil Kemenag Tampak Belakang',
                'active' => 'yes',
            ),
            2 => 
            array (
                'id_carousel' => 3,
                'created_at' => '2023-07-04 19:41:24',
                'updated_at' => '2023-10-26 13:24:28',
                'image_url' => 'https://res.cloudinary.com/dezj1x6xp/image/upload/v1698301460/PandanViewMandeh/AF1QipPJb4rUS-R7njt4Q27YWTspJ10vyr578nIKd1go_s0_ubssbr.jpg',
                'title' => 'Kanwil Tampak Samping',
                'active' => 'yes',
            ),
            3 => 
            array (
                'id_carousel' => 4,
                'created_at' => '2023-07-04 19:41:42',
                'updated_at' => '2023-10-26 13:25:44',
                'image_url' => 'https://res.cloudinary.com/dezj1x6xp/image/upload/v1698301537/PandanViewMandeh/AF1QipPG5apkDszo3Yyg7ft2DoEHehtC9d2PtsPsTwQ_s0_zh3xvw.jpg',
                'title' => 'Kanwil Tampak Atas',
                'active' => 'yes',
            ),
        ));
        
        
    }
}