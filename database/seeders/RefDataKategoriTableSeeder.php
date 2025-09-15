<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RefDataKategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ref_data_kategori')->insert([
            #1
            [
                'name'          => 'Tidak Terkategori'
            ],
            [
                'name'          => 'Laporan'
            ],
            [
                'name'          => 'Urutan Kepegawaian'
            ],
            [
                'name'          => 'Kenaikan Pangkat'
            ],
            [
                'name'          => 'Mutasi'
            ],
            [
                'name'          => 'Pembinaan Karier'
            ],
            [
                'name'          => 'Pensiun'
            ],
            #2
            [
                'name'          => 'Anggaran Masing-Masing Satker'
            ],
            [
                'name'          => 'Realisasi Anggaran Secara Berkala'
            ],
            [
                'name'          => 'Barang Milik Negara'
            ],
            [
                'name'          => 'Perencanaan'
            ],
            #3
            [
                'name'          => 'Madrasah Negeri Dan Swasta'
            ],
            [
                'name'          => 'Raudhatul Athfal'
            ],
            [
                'name'          => 'Guru PNS dan Non PNS'
            ],
            [
                'name'          => 'Tenaga Pendidik PNS dan Non PNS'
            ],
            [
                'name'          => 'Guru Penerima Sertifikasi'
            ],
            [
                'name'          => 'Siswa Madrasah Negeri dan Swasta'
            ],
            [
                'name'          => 'Siswa Raudhatul Athfal'
            ],
            [
                'name'          => 'BMN Madrasah'
            ],
            #4
            [
                'name'          => 'Pondok Pesantren'
            ],
            [
                'name'          => 'Guru Pada Pondok Pesantren'
            ],
            [
                'name'          => 'Siswa Pada Pondok Pesantren'
            ],
            [
                'name'          => 'LPQ / MDT'
            ],
            [
                'name'          => 'Siswa LPQ / MDT'
            ],
            #5
            [
                'name'          => 'Guru PAI PNS dan Non PNS'
            ],
            [
                'name'          => 'Guru PAI Sertifikasi dan Belum Sertifikasi'
            ],
            [
                'name'          => 'Guru PAI Telah dan Belum TPG'
            ],
            [
                'name'          => 'EMIS Guru PAI TK, SD, SMP, SMA dan SMK'
            ],
            #6
            [
                'name'          => 'Jemaah Haji'
            ],
            [
                'name'          => 'Calon Jemaah Haji'
            ],
            [
                'name'          => 'Calon Jemaah Haji Kategori Lansia'
            ],
            [
                'name'          => 'Travel Biro Haji'
            ],
            [
                'name'          => 'Pengurus IPHUI'
            ],
            [
                'name'          => 'KBIH'
            ],
            #7
            [
                'name'          => 'Kantor Urusan Agama (KUA)'
            ],
            [
                'name'          => 'BMN KUA'
            ],
            [
                'name'          => 'Penghulu'
            ],
            [
                'name'          => 'Penyusulu Fungsional dan Non PNS'
            ],
            [
                'name'          => 'Rumah Ibadah'
            ],
            [
                'name'          => 'Produk Halal'
            ],
            [
                'name'          => 'Penduduk Berdasarkan Agama'
            ],
            [
                'name'          => 'Lembaga Seni dan Budaya'
            ],
            [
                'name'          => 'Organisasi Masyarakat'
            ],
            #8
            [
                'name'          => 'Tanah Wakaf'
            ],
            [
                'name'          => 'Zakat'
            ],

        ]);
    }
}
