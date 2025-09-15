<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use URL;

class RefDataClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ref_data_klasifikasi')->insert([
            [
                'id_data_klasifikasi' => 1,
                'name' => 'Informasi Berkala',
                'slug' => 'informasi_berkala'
            ],
            [
                'id_data_klasifikasi' => 2,
                'name' => 'Informasi Setiap Saat',
                'slug' => 'informasi_setiap_saat'
            ],
            [
                'id_data_klasifikasi' => 3,
                'name' => 'Informasi Serta Merta',
                'slug' => 'informasi_serta_merta'
            ],
            [
                'id_data_klasifikasi' => 4,
                'name' => 'Informasi Dikecualikan',
                'slug' => 'informasi_dikecualikan'
            ]
        ]);

        DB::table('ref_data_sub_klasifikasi')->insert([
            [
                'id_data_sub_klasifikasi' => 1,
                'id_data_klasifikasi' => 1,
                'name' => 'Informasi yang berkaitan dengan Instansi'
            ],
            [
                'id_data_sub_klasifikasi' => 2,
                'id_data_klasifikasi' => 1,
                'name' => 'Informasi Kegiatan dan Kinerja Instansi'
            ],
            [
                'id_data_sub_klasifikasi' => 3,
                'id_data_klasifikasi' => 1,
                'name' => 'Informasi mengenai Laporan Keuangan'
            ],
            [
                'id_data_sub_klasifikasi' => 4,
                'id_data_klasifikasi' => 1,
                'name' => 'Informasi lain yang diatur dalam Peraturan Perundang-undangan'
            ],


            [
                'id_data_sub_klasifikasi' => 5,
                'id_data_klasifikasi' => 2,
                'name' => 'Daftar Informasi Publik yang berada dibawah penguasaannya'
            ],
            [
                'id_data_sub_klasifikasi' => 6,
                'id_data_klasifikasi' => 2,
                'name' => 'Hasil Keputusan Instansi dan Pertimbangannya'
            ],
            [
                'id_data_sub_klasifikasi' => 7,
                'id_data_klasifikasi' => 2,
                'name' => 'Seluruh Kebijakan yang ada berikut dokumen pendukungnya'
            ],
            [
                'id_data_sub_klasifikasi' => 8,
                'id_data_klasifikasi' => 2,
                'name' => 'Rencana Kerja Proyek termasuk perkiraan pengeluaran Tahunan'
            ],
            [
                'id_data_sub_klasifikasi' => 9,
                'id_data_klasifikasi' => 2,
                'name' => 'Perjanjian Instansi dengan Pihak ke III'
            ],
            [
                'id_data_sub_klasifikasi' => 10,
                'id_data_klasifikasi' => 2,
                'name' => 'Informasi dan Kebijakan yang disampaikan Pejabat dalam pertemuan terbuka'
            ],

            [
                'id_data_sub_klasifikasi' => 11,
                'id_data_klasifikasi' => 3,
                'name' => 'Informasi yang dapat mengancam hajat hidup orang banyak dan ketertiban umum'
            ],

            [
                'id_data_sub_klasifikasi' => 12,
                'id_data_klasifikasi' => 4,
                'name' => 'Informasi yang dikecualikan'
            ],
        ]);

        // DB::table('trx_data_file')->insert([
        //     [
        //         'id_data_file' => 1,
        //         'id_data_seksi' => 1,
        //         'id_data_kategori' => 1,
        //         'id_data_jenis' => 1,
        //         'id_data_klasifikasi' => null,
        //         'nama_file' => 'Data Laporan Urutan Kepegawaian',
        //         'ext' => 'xlsx',
        //         'url_file' => URL::to('/') . '/data-urutan-kepegawaian.xlsx',
        //         'tags' => 'pegawai, kemenag, data pegawai',
        //         'keterangan' => 'Merupakan laporan data terkait daftar kepegawaian',
        //         'akses' => 'public',
        //         'status' => 'draft',
        //         'bentuk' => 'online',
        //         'hits' => 30,
        //         'download' => 24,
        //         'tempat' => 'Painan',
        //         'penanggung_jawab' => 'Kemenag Pessel'
        //     ]
        //     ]);
    }
}
