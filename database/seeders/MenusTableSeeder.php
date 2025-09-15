<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menus')->delete();
        
        \DB::table('menus')->insert(array (
            0 => 
            array (
                'id' => 1,
                'created_at' => '2023-08-30 10:42:54',
                'updated_at' => '2023-10-31 09:56:00',
                'title' => 'Header',
                'location' => 'header',
                'content' => '[[{"id":11,"title":"Beranda","target":"_self","slug":"#","type":"custom","children":[[]]},{"id":35,"title":"Profil","target":"_self","slug":"profil","type":"category","children":[[{"id":47,"title":"Data Pegawai","target":"_blank","slug":"https://simpeg.kemenag.go.id/laporan/total_pegawai.aspx","type":"custom","children":[[]]},{"id":37,"title":"Struktur Organisasi","target":"_self","slug":"post/struktur-organisasi","type":"post","children":[[]]},{"id":48,"title":"Sejarah Kementerian Agama","target":"_self","slug":"post/sejarah-kementerian-agama","type":"post","children":[[]]},{"id":49,"title":"Visi Misi Kementerian Agama","target":"_self","slug":"post/visi-misi-kementerian-agama","type":"post","children":[[]]},{"id":50,"title":"Kedudukan, Tugas dan Fungsi Kementerian Agama Provinsi","target":"_self","slug":"post/kedudukan-tugas-dan-fungsi-kementerian-agama-provinsi","type":"post","children":[[]]},{"id":77,"title":"Kakanwil Sumbar dari Masa ke Masa","target":"_self","slug":"post/kakanwil-sumbar-dari-masa-ke-masa","type":"post","children":[[]]},{"id":78,"title":"Tentang Sumatera Barat","target":"_self","slug":"post/tentang-sumatera-barat","type":"post","children":[[]]}]]},{"id":62,"title":"Berita","target":"_self","slug":"berita","type":"category","children":[[{"id":65,"title":"Utama","target":"_self","slug":"blog?category=utama","type":"custom","children":[[]]},{"id":66,"title":"Daerah","target":"_self","slug":"blog?category=daerah","type":"custom","children":[[]]},{"id":67,"title":"Nasional","target":"_self","slug":"blog?category=nasional","type":"custom","children":[[]]},{"id":68,"title":"Internasional","target":"_self","slug":"blog?category=internasional","type":"custom","children":[[]]}]]},{"id":43,"title":"Kolom","target":"_self","slug":"#","type":"custom","children":[[{"id":45,"title":"Opini","target":"_self","slug":"blog?category=opini","type":"custom","children":[[]]},{"id":39,"title":"Artikel","target":"_self","slug":"blog?category=artikel","type":"custom","children":[[]]},{"id":46,"title":"Wawancara","target":"_self","slug":"blog?category=wawancara","type":"custom","children":[[]]}]]},{"id":87,"title":"Unit Kerja","target":"_self","slug":"/unit-kerja","type":"custom","children":[[{"id":103,"title":"Kabupaten Kepulauan Mentawai","target":"_self","slug":"post/kabupaten-kepulauan-mentawai","type":"post","children":[[]]},{"id":88,"title":"Kabupaten Pesisir Selatan","target":"_self","slug":"post/kabupaten-pesisir-selatan","type":"post","children":[[]]},{"id":106,"title":"Kabupaten Solok","target":"_self","slug":"post/kabupaten-solok","type":"post","children":[[]]},{"id":98,"title":"Kota Solok","target":"_self","slug":"post/kota-solok","type":"post","children":[[]]},{"id":99,"title":"Kabupaten Sijunjung","target":"_self","slug":"post/kabupaten-sijunjung","type":"post","children":[[]]},{"id":96,"title":"Kabupaten Tanah Datar","target":"_self","slug":"post/kabupaten-tanah-datar","type":"post","children":[[]]},{"id":101,"title":"Kabupaten Padang Pariaman","target":"_self","slug":"post/kabupaten-padang-pariaman","type":"post","children":[[]]},{"id":89,"title":"Kabupaten Agam","target":"_self","slug":"post/kabupaten-agam","type":"post","children":[[]]},{"id":102,"title":"Kabupaten Lima Puluh Kota","target":"_self","slug":"post/kabupaten-lima-puluh-kota","type":"post","children":[[]]},{"id":100,"title":"Kabupaten Pasaman","target":"_self","slug":"post/kabupaten-pasaman","type":"post","children":[[]]},{"id":97,"title":"Kabupaten Solok Selatan","target":"_self","slug":"post/kabupaten-solok-selatan","type":"post","children":[[]]},{"id":104,"title":"Kabupaten Dharmasraya","target":"_self","slug":"post/kabupaten-dharmasraya","type":"post","children":[[]]},{"id":105,"title":"Kabupaten Pasaman Barat","target":"_self","slug":"post/kabupaten-pasaman-barat","type":"post","children":[[]]},{"id":94,"title":"Kota Padang","target":"_self","slug":"post/kota-padang","type":"post","children":[[]]},{"id":90,"title":"Kota Sawahlunto","target":"_self","slug":"post/kota-sawahlunto","type":"post","children":[[]]},{"id":93,"title":"Kota Padang Panjang","target":"_self","slug":"post/kota-padang-panjang","type":"post","children":[[]]},{"id":95,"title":"Kota Bukittinggi","target":"_self","slug":"post/kota-bukittinggi","type":"post","children":[[]]},{"id":91,"title":"Kota Payakumbuh","target":"_self","slug":"post/kota-payakumbuh","type":"post","children":[[]]},{"id":92,"title":"Kota Pariaman","target":"_self","slug":"post/kota-pariaman","type":"post","children":[[]]}]]},{"id":38,"title":"Galeri","target":"_self","slug":"sect/gallery","type":"custom","children":[[{"id":79,"title":"Foto Peristiwa","target":"_self","slug":"gallery/t/foto","type":"custom","children":[[]]},{"id":80,"title":"Video","target":"_self","slug":"gallery/t/video","type":"custom","children":[[]]}]]},{"id":70,"title":"Informasi Publik","target":"_self","slug":"#","type":"custom","children":[[{"id":71,"title":"Semua Informasi Publik","target":"_self","slug":"info/semua_informasi_publik","type":"custom","children":[[]]},{"id":72,"title":"Informasi Serta Merta","target":"_self","slug":"info/informasi_serta_merta","type":"custom","children":[[]]},{"id":73,"title":"Informasi Setiap Saat","target":"_self","slug":"info/informasi_setiap_saat","type":"custom","children":[[]]},{"id":74,"title":"Informasi Berkala","target":"_self","slug":"info/informasi_berkala","type":"custom","children":[[]]},{"id":75,"title":"Informasi Dikecualikan","target":"_self","slug":"info/informasi_dikecualikan","type":"custom","children":[[]]}]]},{"id":41,"title":"Pengaduan","target":"_self","slug":"#","type":"custom","children":[[{"id":76,"title":"Pengaduan Masyarakat","target":"_self","slug":"https://siguntur.kemenag.go.id/ptsp/login","type":"custom","children":[[]]},{"id":36,"title":"Kotak Saran","target":"_self","slug":"contact","type":"custom","children":[[]]}]]},{"id":42,"title":"Layanan Publik","target":"_self","slug":"#","type":"custom","children":[[{"id":64,"title":"SIMKAH","target":"_blank","slug":"https://simkah.kemenag.go.id/index.php","type":"custom","children":[[]]}]]}]]',
            ),
        ));
        
        
    }
}