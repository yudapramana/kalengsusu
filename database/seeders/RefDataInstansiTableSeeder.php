<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RefDataInstansiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ref_data_instansi')->insert([
            ['name' => 'Bagian Tata Usaha - Subbagian Perencanaan, Data, dan Informasi'],
            ['name' => 'Bagian Tata Usaha - Subbagian Keuangan dan Barang Milik Negara'],
            ['name' => 'Bagian Tata Usaha - Subbagian Kepegawaian dan Hukum'],
            ['name' => 'Bagian Tata Usaha - Subbagian Organisasi, Tata Laksana, dan Kerukunan Umat Beragama'],
            ['name' => 'Bagian Tata Usaha - Subbagian Umum dan Hubungan Masyarakat'],
            ['name' => 'Bidang Pendidikan Madrasah'],
            ['name' => 'Bidang Diniyah dan Pondok Pesantren'],
            ['name' => 'Bidang Pendidikan Agama Islam'],
            ['name' => 'Bidang Penyelenggara Haji dan Umrah'],
            ['name' => 'Bidang Urusan Agama Islam'],
            ['name' => 'Bidang Penerangan Agama Islam, dan Pemberdayaan Zakat dan Wakaf'],
            ['name' => 'Pembimbing Masyarakat Kristen'],
            ['name' => 'Pembimbing Masyarakat Katolik'],
            ['name' => 'Pembimbing Masyarakat Hindu'],
            ['name' => 'Pembimbing Masyarakat Buddha']
        ]);
    }
}
