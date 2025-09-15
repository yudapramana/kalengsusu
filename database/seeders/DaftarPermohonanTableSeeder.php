<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DaftarPermohonanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('daftar_permohonan')->delete();
        
        \DB::table('daftar_permohonan')->insert(array (
            0 => 
            array (
                'id_permohonan' => 1,
                'created_at' => '2023-09-04 18:48:33',
                'updated_at' => '2023-09-04 18:59:46',
                'deleted_at' => NULL,
                'user_id' => NULL,
                'nomor_permohonan' => NULL,
                'jenis_pemohon' => 'kelompok',
                'jenis_identitas' => 'badan hukum',
                'nomor_identitas' => 'Kantor Wilayah Kementerian Agama Prov. Sumatera Barat',
                'nama_pemohon' => 'Dr. H. Helmi, M.Ag',
                'email' => 'helmikhatib@kemenag.go.id',
                'no_telp' => '-',
                'alamat' => 'Jl. Kuini No.79B, Ujung Gurun, Kec. Padang Bar., Kota Padang, Sumatera Barat 25114',
                'pekerjaan' => 'ASN',
                'identity_url' => 'https://res.cloudinary.com/kominfo-sb/image/upload/v1693828113/Si-PABO/krwaxv3uzkb9rwjph14a.jpg',
                'rincian_informasi' => 'Permintaan Data Keagamaan pada Tahun 2022 dan 2023',
                'tujuan_penggunaan_informasi' => 'Pelaksanaan Penyusunan Bahan Publikasi Tingkat
Provinsi',
                'cara_pemakaian_informasi' => 'bekerja',
                'cara_memperoleh_informasi' => 'elektronik',
                'bentuk_informasi' => 'softcopy',
                'cara_mendapatkan_salinan' => 'email',
                'status_permohonan' => 'selesai',
            ),
            1 => 
            array (
                'id_permohonan' => 2,
                'created_at' => '2023-09-04 18:55:50',
                'updated_at' => '2023-09-04 18:59:51',
                'deleted_at' => NULL,
                'user_id' => NULL,
                'nomor_permohonan' => NULL,
                'jenis_pemohon' => 'kelompok',
                'jenis_identitas' => 'badan hukum',
                'nomor_identitas' => '1371102907940005',
                'nama_pemohon' => 'Dinas Sosial, Pemberdayaan Perempuan dan Perlindungan Anak',
                'email' => 'dinsospessel@gmail.com',
                'no_telp' => '-',
                'alamat' => 'JL.H. llyas Yacoub - Painan',
                'pekerjaan' => 'ASN',
                'identity_url' => 'https://res.cloudinary.com/kominfo-sb/image/upload/v1693828465/Si-PABO/ooqkahyrvyy0hvku0xie.jpg',
            'rincian_informasi' => 'Dalam rangka memenuhi pengisian indikator penilaian Kabupaten Layak Anak ( KLA) maka kami minta bantuan Saudara menyediakan data BNBA',
                'tujuan_penggunaan_informasi' => 'memenuhi pengisian indikator penilaian Kabupaten Layak
Anak',
                'cara_pemakaian_informasi' => 'bekerja',
                'cara_memperoleh_informasi' => 'elektronik',
                'bentuk_informasi' => 'hardcopy',
                'cara_mendapatkan_salinan' => 'email',
                'status_permohonan' => 'selesai',
            ),
            2 => 
            array (
                'id_permohonan' => 3,
                'created_at' => '2023-09-04 18:58:50',
                'updated_at' => '2023-09-04 18:59:57',
                'deleted_at' => NULL,
                'user_id' => NULL,
                'nomor_permohonan' => NULL,
                'jenis_pemohon' => 'pribadi',
                'jenis_identitas' => 'badan hukum',
                'nomor_identitas' => 'Kanwil Kementerian Agama Prov. Sumatera Barat',
                'nama_pemohon' => 'Dr. H. Helmi, M.Ag',
                'email' => 'helmikhatib@kemenag.go.id',
                'no_telp' => '-',
                'alamat' => 'Jl. Kuini No.79B, Ujung Gurun, Kec. Padang Bar., Kota Padang, Sumatera Barat 25114',
                'pekerjaan' => 'ASN',
                'identity_url' => 'https://res.cloudinary.com/kominfo-sb/image/upload/v1693828704/Si-PABO/cwrtpcu3xckziy01w1ur.jpg',
                'rincian_informasi' => 'Permintaan Data Calon Penerima Tunjangan Insentif Guru PAI bukan PNS dan bukan PPPK Tahun 2023',
                'tujuan_penggunaan_informasi' => 'Pengajuan Calon Penerima Tunjangan Insentif Guru PAI bukan PNS dan bukan PPPK Tahun 2023',
                'cara_pemakaian_informasi' => 'bekerja',
                'cara_memperoleh_informasi' => 'elektronik',
                'bentuk_informasi' => 'softcopy',
                'cara_mendapatkan_salinan' => 'email',
                'status_permohonan' => 'selesai',
            ),
            3 => 
            array (
                'id_permohonan' => 4,
                'created_at' => '2023-09-04 19:11:06',
                'updated_at' => '2023-09-04 19:11:06',
                'deleted_at' => NULL,
                'user_id' => NULL,
                'nomor_permohonan' => NULL,
                'jenis_pemohon' => 'kelompok',
                'jenis_identitas' => 'badan hukum',
                'nomor_identitas' => 'Badan Pusat Statistik Kabupaten Pesisir Selatan',
                'nama_pemohon' => 'Yudi Yos Elvin, S.Si, M.Si',
                'email' => 'pessel@bps.go.id',
                'no_telp' => '075627004',
                'alamat' => 'Jl. Setia Budi Painan',
                'pekerjaan' => 'ASN',
                'identity_url' => 'https://res.cloudinary.com/kominfo-sb/image/upload/v1693829370/Si-PABO/zrkj77l1qbtol8iwqcoc.jpg',
                'rincian_informasi' => 'Permintaan Data Keagamaan seperti Masjid, KUA dan lain-lain',
                'tujuan_penggunaan_informasi' => 'Pelaporan data Statistik Kabupaten Pesisir Selatan',
                'cara_pemakaian_informasi' => 'bekerja',
                'cara_memperoleh_informasi' => 'elektronik',
                'bentuk_informasi' => 'softcopy',
                'cara_mendapatkan_salinan' => 'email',
                'status_permohonan' => 'baru',
            ),
            4 => 
            array (
                'id_permohonan' => 5,
                'created_at' => '2023-09-04 19:14:18',
                'updated_at' => '2023-09-04 19:14:18',
                'deleted_at' => NULL,
                'user_id' => NULL,
                'nomor_permohonan' => NULL,
                'jenis_pemohon' => 'kelompok',
                'jenis_identitas' => 'badan hukum',
                'nomor_identitas' => 'Bank Tabungan Pensiunan Negara',
                'nama_pemohon' => 'Helfi Yanrika',
                'email' => 'painan@btpn.go.id',
                'no_telp' => '-',
                'alamat' => 'Jl. Ilyas Yakub IV Jurai, Kel. Nagari Painan, Kec. IV Jurai, Kab. Pesisir Selatan, Sumatera Barat',
                'pekerjaan' => 'ASN',
                'identity_url' => 'https://res.cloudinary.com/kominfo-sb/image/upload/v1693829618/Si-PABO/gxu9csezyfqqh589ypha.jpg',
                'rincian_informasi' => 'Permintaan Data Pensiunan Kementerian Agama Kab Pesisir Selatan',
                'tujuan_penggunaan_informasi' => 'Laporan dan Pengumpulan data Pensiunan',
                'cara_pemakaian_informasi' => 'bekerja',
                'cara_memperoleh_informasi' => 'elektronik',
                'bentuk_informasi' => 'softcopy',
                'cara_mendapatkan_salinan' => 'email',
                'status_permohonan' => 'baru',
            ),
        ));
        
        
    }
}