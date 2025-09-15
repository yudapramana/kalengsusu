<?php

namespace App\Http\Controllers;

use App\Models\RefDataInstansi;
use App\Models\RefDataKategori;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, $param){

        $data = $request->input();

        if($param == 'kategori') {
            $datas = RefDataKategori::where('name','like', '%' .  $data['q'] . '%')
            ->get();
        }

        if($param == 'instansi') {
            $datas = RefDataInstansi::where('name','like', '%' .  $data['q'] . '%')
                        ->get();
        }

    
        return response()->json($datas);

    }
}
