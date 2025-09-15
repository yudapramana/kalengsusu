<?php

namespace App\Http\Controllers\Landing;

use App\Models\RefDataSeksi;
use App\Models\RefDataKategori;
use App\Models\RefDataLabel;
use App\Models\TrxDataFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;
use Spatie\MediaLibrary\Support\MediaStream;

class PostController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($idx)
    {
        $id = Hashids::decode($idx);
        $dataFile = TrxDataFile::where('id_data_file', $id)->with('instansi', 'kategori')->first();
        if ($dataFile) {

            $categories = \App\Models\Category::withCount('posts')->get();
            $tags = \App\Models\Tag::all();
            $recent_posts = \App\Models\Post::whereHas('category', function($q){
                $q->where('slug', 'utama');
            })->take(3)->get();

            $dataFile->increment('hits');
            return view('landing.v2.data', [
                'dataFile' => $dataFile,
                'title' => 'Detail Data',
                'categories' =>  $categories,
                'recent_posts' => $recent_posts,
                'tags' => $tags,
                'keterangan' => $dataFile->keterangan
            ]);
        } else {
            abort(404, 'Page Not found');
        }
    }

    public function download($idx)
    {
        $id = Hashids::decode($idx);
        $dataFile = TrxDataFile::where('id_data_file', $id)->with('instansi', 'kategori')->first();
        $dataFile->increment('download');

        $downloads = $dataFile->getMedia('data_file');
        $filename = $dataFile->nama_file . '.zip';
        return MediaStream::create($filename)->addMedia($downloads);
    }
}
