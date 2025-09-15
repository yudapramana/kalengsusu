<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Permohonan;
use Response;
use Illuminate\Support\Facades\Validator;

class PermohonanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $datas = \App\Models\Permohonan::all();
            return Datatables::of($datas)
            ->addIndexColumn()
            ->editColumn('status_permohonan_old', function ($item) {
                $color = $item->status_permohonan == 'baru' ? 'primary' : ($item->status_permohonan == 'proses' ? 'warning' : 'success');


                return '<span  class="badge bg-'.$color.'">' . $item->status_permohonan . '</span>';
            })

            ->addColumn('status_permohonan', function ($item) {

                $colors = [
                    'baru' => 'warning',
                    'proses' => 'primary',
                    'selesai' => 'success',
                    'batal' => 'danger',
                ];

                $nowColor = $colors[$item->status_permohonan];
                 
                unset($colors[$item->status_permohonan]);



                $btn = '<span class="badge bg-'.$nowColor.' dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-original-title="" title="">'.$item->status_permohonan.'</span>';
                $btn .= '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">';

                foreach ($colors as $key => $color) {
                    # code...
                    $btn .= '<button id="switchBtn" class="dropdown-item" tabindex="0" aria-controls="defTbl" title="" data-bs-original-title="Switch Status" type="button" data-status="'.$key.'"><span>ubah menjadi '.$key.'</span></button>';
                }
                        $btn .= '</div>';
                return $btn;
            })
            
            ->addColumn('action', function ($item) {
                $btn = '<span class="badge bg-primary dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-original-title="" title="">tindakan</span>';
                $btn .= '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <button id="editBtn" class="dropdown-item" tabindex="0" aria-controls="defTbl" title="" data-bs-original-title="Edit Data" data-bs-target="#defModal" data-bs-toggle="modal" data-bs-backdrop="static" data-bs-keyboard="false" type="button" id="editBtn"><span>lihat data</span></button>
                    </div>';
                return $btn;
            })
            ->rawColumns(['action', 'status_permohonan'])

            ->make(true);

        }

        return view('admin.permohonan.index', [
            'title'  => 'Daftar Permohonan',
            'br1'  => 'Pengelolaan',
            'br2'  => 'Permohonan',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function switchStatus(Request $request)
    {
        $success = false;
        $message = '';

        try {
            $data = $request->input();

            if(isset($request->switch_status)){
                $itemFile = Permohonan::find($data['id_permohonan']);
                $itemFile->status_permohonan = $request->status_permohonan;
                $itemFile->save();
            } 

            $success = true;
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return response()
            ->json(['success' => $success, 'message' => $message]);
    }
}
