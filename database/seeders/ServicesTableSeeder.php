<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('services')->delete();
        
        \DB::table('services')->insert(array (
            0 => 
            array (
                'id_service' => 1,
                'created_at' => '2023-06-20 10:26:54',
                'updated_at' => '2023-08-30 17:28:29',
                'cover_image_url' => 'https://res.cloudinary.com/dezj1x6xp/image/upload/v1693384641/PandanViewMandeh/landing-logo_qir7eu.svg',
                'content_image_url' => 'https://res.cloudinary.com/dezj1x6xp/image/upload/v1687278150/PandanViewMandeh/_LAYOUT_u0nlql.jpg',
                'next_url' => '/post/profil-ppid',
                'title_id' => 'Selamat Datang di Portal PPID Kantor Wilayah Kementerian Agama Prov. Sumatera Barat',
                'title_en' => 'Selamat Datang di Portal PPID Kantor Wilayah Kementerian Agama Prov. Sumatera Barat',
                'name' => 'Selamat Datang di Portal Web Kemenag Kanwil Prov Sumbar',
                'slug' => NULL,
                'featured' => 'yes',
                'listed' => 'no',
            'description' => 'Selamat datang di Portal PPID Kementerian Agama Kabupaten Pesisir Selatan (KemenagPessel). Ini adalah ruang virtual di mana pintu informasi terbuka lebar. Portal ini hadir dengan tujuan untuk memberikan akses yang mudah dan transparan kepada publik atas segala hal yang berkaitan dengan aktivitas, layanan, program, dan berbagai informasi relevan yang diselenggarakan oleh Kementerian Agama Kabupaten Pesisir Selatan. 

Melalui tata kelola yang ketat dan komitmen terhadap transparansi, kami berharap portal ini akan menjadi sumber pengetahuan yang berharga bagi warga, stakeholder, serta siapa pun yang ingin mendapatkan wawasan mendalam tentang berbagai aspek yang kami uraikan.',
            ),
        ));
        
        
    }
}