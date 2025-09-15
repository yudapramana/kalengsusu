<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use App\Models\RefDataInstansi;
use App\Models\RefDataKlasifikasi;
use App\Models\TrxDataFile;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $services = \App\Models\Services::where('featured', 'yes')->get();
        $carousels = \App\Models\Carousel::where('active', 'yes')->get();

        $featureds = \App\Models\Post::where('status', 'published')->where('is_featured', 1)->orderBy('created_at', 'DESC')->take(8)->get();

        $main_posts = \App\Models\Post::where('status', 'published')->whereHas('category', function ($q) {
            $q->where('slug', 'utama');
        })->orderBy('created_at', 'DESC')->take(6)->get();
        $main_posts = $main_posts->shuffle();

        $recent_posts =  \App\Models\Post::where('status', 'published')->whereHas('category', function ($q) {
            $q->where('slug', '!=' , 'artikel');
        })->orderBy('created_at', 'DESC')->take(3)->get();
        
        $activities = \App\Models\Activity::orderBy('created_at', 'DESC')->take(6)->get();

        $totalpermohonanselesai = Permohonan::count();

        $daerah_posts = \App\Models\Post::where('status', 'published')->whereHas('category', function ($q) {
            $q->where('slug', 'daerah');
        })->orderBy('created_at', 'DESC')->take(12)->get();

        $daerah_posts_chunk = $daerah_posts->chunk(4);

        return view('landing.v2.home', [
            'title' => 'Web Utama Kantor Wilayah Kementerian Agama Provinsi Sumatera Barat',
            'accountfb' => 'pandanviewmandeh',
            'account' => 'pandanviewmandeh',
            'channel' =>  '@pandanviewmandehofficial4919',
            'services' =>  $services,
            'carousels' =>  $carousels,
            'recent_posts' => $recent_posts,
            'activities' => $activities,
            'totalpermohonanselesai' => $totalpermohonanselesai,
            'daerah_posts' => $daerah_posts,
            'daerah_posts_chunk' => $daerah_posts_chunk,
            'featureds' => $featureds,
            'main_posts' => $main_posts,
        ]);
    }


    public function info($sect)
    {

        // $sect = $this->_toUpper($sect);
        $klasifikasi_s = RefDataKlasifikasi::where('slug', $sect)->first();
        $id_data_klasifikasi = null;
        if ($klasifikasi_s) {
            $id_data_klasifikasi = $klasifikasi_s->id_data_klasifikasi;
        }

        if ($id_data_klasifikasi == null && $sect != 'semua_informasi_publik') {
            abort(404);
        }




        $instansi_s = RefDataInstansi::all();
        return view('landing.v2.info', [
            'instansi_s' => $instansi_s,
            'klasifikasi_s' => $klasifikasi_s,
            'id_data_klasifikasi' => $id_data_klasifikasi,
            'sect' => $this->_toUpper($sect),
            'title' => 'Web - ' . $this->_toUpper($sect),
        ]);
        
    }

    public function _toUpper($string, $capitalizeFirstCharacter = true)
    {

        $str = ucwords(str_replace('_', ' ', $string));

        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }

        return $str;
    }

    public function all(Request $request)
    {
        $search = $request['search'];
        $id_data_instansi = $request['id_data_instansi'];
        $id_data_klasifikasi = null;
        if ($request['id_data_klasifikasi'] != '') {
            $id_data_klasifikasi = $request['id_data_klasifikasi'];
        }


        $query = TrxDataFile::query();
        // $query = $query->whereHas('datalabel');
        // $query = $query->with('datalabel.datakategori.dataseksi');
        $query = $query->with('instansi', 'kategori', 'klasifikasi', 'subklasifikasi');


        if ($search) {
            if ($id_data_klasifikasi) {
                $query = $query->where('id_data_klasifikasi', $id_data_klasifikasi);
            }
            $query = $query->where('nama_file', 'like', '%' . $search . '%')
                ->orWhere('keterangan', 'like', '%' . $search . '%');
        }

        if ($id_data_klasifikasi) {
            $query = $query->where('id_data_klasifikasi', $id_data_klasifikasi);
        }

        if ($id_data_instansi) {
            $query = $query->where('id_data_instansi', $id_data_instansi);
        }

        $datas = $query->paginate(10);
        return $datas;
    }
}
