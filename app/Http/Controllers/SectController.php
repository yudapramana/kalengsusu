<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Carbon\Carbon;

class SectController extends Controller
{
    public function permohonan() {
        return view('landing.v2.permohonan', [
            'title' => 'Web - Kantor Wilayah Kementerian Agama Prov. Sumatera Barat',
        ]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePermohonan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'captcha' => 'required|captcha'
        ], [
            'captcha.captcha' => 'Kode Captcha Tidak Sesuai.'
        ]);

        $input = $request->input();

        if ($validator->passes()) {
            try {

                $jumlahPermohonan = \App\Models\Permohonan::where('nomor_identitas', $input['nomor_identitas'])
                ->whereDate('created_at', \Carbon\Carbon::today())
                ->count();


                if($jumlahPermohonan >= 3){
                    throw new \Exception("Nomor Identitas tersebut sudah melakukan permohonan lebih dari 1 kali pada hari ini.");
                }


                // Store your user in database
                $permohonan = new \App\Models\Permohonan();
                $permohonan->jenis_pemohon = $request->jenis_pemohon;
                $permohonan->jenis_identitas = $request->jenis_identitas;
                $permohonan->nomor_identitas = $request->nomor_identitas;
                $permohonan->nama_pemohon = $request->nama_pemohon;
                $permohonan->email = $request->email;
                $permohonan->no_telp = $request->no_telp;
                $permohonan->alamat = $request->alamat;
                $permohonan->pekerjaan = $request->pekerjaan;
                $permohonan->identity_url = $request->identity_url;
                $permohonan->rincian_informasi = $request->rincian_informasi;
                $permohonan->tujuan_penggunaan_informasi = $request->tujuan_penggunaan_informasi;
                $permohonan->cara_pemakaian_informasi = $request->cara_pemakaian_informasi;
                $permohonan->cara_memperoleh_informasi = $request->cara_memperoleh_informasi;
                $permohonan->bentuk_informasi = $request->bentuk_informasi;
                $permohonan->cara_mendapatkan_salinan = $request->cara_mendapatkan_salinan;

                $permohonan->save();

                return Response::json(['success' => 'yeah']);
                
            } catch (\Exception $e) {
                return Response::json(['status' => 'error', 'message' => $e->getMessage()]);
            } 

            
        } else {
            return Response::json(['errors' => $validator->errors()], 422);
        }
    }

    public function gallery($type = 'foto') {

        // return $type;

        $galleries = \App\Models\Gallery::where('type', $type)->get();
        $galleries = $galleries->shuffle();

        $filterTags = $galleries->pluck('filter_tag')->unique();

        return view('landing.v2.gallery', [
            'title' => 'Galeri ' . ucfirst($type) . 'Kantor Wilayah Kementerian Agama Prov. Sumatera Barat',
            'galleries' =>  $galleries,
            'filterTags' =>  $filterTags,
            'type' =>  $type,
        ]);
    }
}
