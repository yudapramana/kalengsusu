<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RefDataInstansi;
use App\Models\TrxDataFile;
use App\Models\RefDataKlasifikasi;
use App\Models\RefDataKategori;
use App\Models\RefDataSubKlasifikasi;
use App\Models\TemporaryFile;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use URL;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = TrxDataFile::with('instansi', 'kategori', 'klasifikasi', 'subklasifikasi')->orderBy('created_at', 'DESC')->get();

        if ($request->ajax()) {
            return DataTables::of($datas)
            ->addIndexColumn()
            ->addColumn('jenisklasifikasiinformasi', function ($item) {
                return ($item->klasifikasi ? $item->klasifikasi->name : 'n/a') . '<hr />' .  ($item->subklasifikasi ? $item->subklasifikasi->name : 'n/a');
            })
            ->addColumn('instansipenanggungjawab', function ($item) {
                return ($item->instansi ? $item->instansi->name : 'n/a') . ' / ' . $item->penanggung_jawab;
            })
            ->addColumn('fileketerangan', function ($item) {

                $colors = [
                    'public' => 'primary',
                    'private' => 'secondary',
                    'user' => 'success',
                    'cetak' => 'info',
                    'online' => 'dark',
                    'rekam' => 'danger',
                ];

                return
                '<span  class="badge bg-'.$colors[$item->bentuk].'">' . $item->bentuk . '</span>&nbsp;' .
                '<span  class="badge bg-'.$colors[$item->akses].'">' . $item->akses . '</span>' .
                '<br><u><a target="_blank" href="'.$item->url_file.'">' .$item->nama_file . '.' . $item->ext .'</a></u>' .
                '<br>' . $item->keterangan;
            })
            ->addColumn('tahun_tempat', function ($item) {
                $str = $item->tahun . ' / ' . $item->tempat;
                return $str;
            })
            ->addColumn('datastatus', function ($item) {
                $now = $item->status;
                $notNow = $item->status == 'draft' ? 'publish' : 'draft';
                $nowColor = $item->status == 'draft' ? 'danger' : 'success';
                $notNowColor = $item->status == 'draft' ? 'success' : 'danger';

                $btn = '<span class="badge bg-'.$nowColor.' dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-original-title="" title="">'.$now.'</span>';
                $btn .= '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <button id="switchBtn" class="dropdown-item" tabindex="0" aria-controls="defTbl" title="" data-bs-original-title="Switch Status" type="button" data-status="'.$notNow.'"><span>ubah menjadi '.$notNow.'</span></button>
                    </div>';
                return $btn;
            })
            ->addColumn('action', function ($item) {
                $btn = '<span class="badge bg-primary dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-original-title="" title="">tindakan</span>';
                $btn .= '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <button id="editBtn" class="dropdown-item" tabindex="0" aria-controls="defTbl" title="" data-bs-original-title="Edit Data" data-bs-target="#defModal" data-bs-toggle="modal" data-bs-backdrop="static" data-bs-keyboard="false" type="button" id="editBtn"><span>edit data</span></button>
                    </div>';
                return $btn;
            })
            ->rawColumns(['action', 'datastatus', 'jenisklasifikasiinformasi', 'instansipenanggungjawab', 'fileketerangan', 'tahun_tempat'])
            ->make(true);
        }


        // $datas = TrxDataFile::with('dataseksi', 'datakategori', 'datajenis', 'dataklasifikasi')->get();
        // return $datas;

        return view('admin.info.index', [
            'title'  => 'Pengelolaan Informasi',
            'br1'  => 'Pengelolaan',
            'br2'  => 'Informasi',
            'klasifikasi_s'     => RefDataKlasifikasi::all(),
            'subklasifikasi_s'  => RefDataSubKlasifikasi::all(),
            'instansi_s'        => RefDataInstansi::all(),
            'kategori_s'        => RefDataKategori::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $success = false;
        $message = '';

        try {
            $data = $request->input();

            if(isset($request->switch_status)){
                $itemFile = TrxDataFile::find($data['id_data_file_switch']);
                $itemFile->status = $request->switch_status;
                $itemFile->save();
            } elseif ($data['id_data_file'] != '') {
                unset($data['data_file_required']);

                if($data['id_data_klasifikasi'] == null || $data['id_data_klasifikasi'] == '') {
                    throw ValidationException::withMessages(['id_data_klasifikasi' => 'Ada data yang belum diisi']);
                }

                if($data['id_data_sub_klasifikasi'] == null || $data['id_data_sub_klasifikasi'] == '') {
                    throw ValidationException::withMessages(['id_data_sub_klasifikasi' => 'Ada data yang belum diisi']);
                }

                if($data['id_data_kategori'] == null || $data['id_data_kategori'] == '') {
                    throw ValidationException::withMessages(['id_data_kategori' => 'Ada data yang belum diisi']);
                }

                if($data['id_data_instansi'] == null || $data['id_data_instansi'] == '') {
                    throw ValidationException::withMessages(['id_data_instansi' => 'Ada data yang belum diisi']);
                }

                $itemFile = TrxDataFile::find($data['id_data_file']);
                $itemFile->nama_file = $data['nama_file'];
                $itemFile->keterangan = $data['keterangan'];
                $itemFile->tahun = $data['tahun'];
                $itemFile->tempat = $data['tempat'];
                $itemFile->penanggung_jawab = $data['penanggung_jawab'];
    
                $itemFile->id_data_klasifikasi = $data['id_data_klasifikasi'];
                $itemFile->id_data_sub_klasifikasi = $data['id_data_sub_klasifikasi'];
                $itemFile->id_data_kategori = $data['id_data_kategori'];
                $itemFile->id_data_instansi = $data['id_data_instansi'];
                
                $itemFile->akses = $data['akses'];
                $itemFile->bentuk = $data['bentuk'];
    
                $itemFile->updated_by = auth()->user()->name;
                $itemFile->save();

                if($request->data_file) {
                    $tempFile = TemporaryFile::where('folder', $request->data_file)->first();
    
                    if ($tempFile) {
                        $url = storage_path('app/public/data_file/tmp/' . $tempFile->folder . '/' . $tempFile->filename);
                        $ext = pathinfo($url, PATHINFO_EXTENSION);
                        $itemFile->addMedia($url)
                                    ->usingName($request->nama_file)
                                    ->usingFileName($request->nama_file . '.' . $ext)
                                    ->toMediaCollection('data_file');
                        rmdir(storage_path('app/public/data_file/tmp/' . $tempFile->folder));
                        $tempFile->delete();
        
                        $mediaFile = $itemFile->getMedia('data_file');
                        $itemFile->update([
                            'url_file'  => $mediaFile[0]->getUrl(),
                            'ext'       => $ext
                        ]);
                    }
                }

            } else {

                if($data['id_data_klasifikasi'] == null || $data['id_data_klasifikasi'] == '') {
                    throw ValidationException::withMessages(['id_data_klasifikasi' => 'Ada data yang belum diisi']);
                }

                if($data['id_data_sub_klasifikasi'] == null || $data['id_data_sub_klasifikasi'] == '') {
                    throw ValidationException::withMessages(['id_data_sub_klasifikasi' => 'Ada data yang belum diisi']);
                }

                if($data['id_data_kategori'] == null || $data['id_data_kategori'] == '') {
                    throw ValidationException::withMessages(['id_data_kategori' => 'Ada data yang belum diisi']);
                }

                if($data['id_data_instansi'] == null || $data['id_data_instansi'] == '') {
                    throw ValidationException::withMessages(['id_data_instansi' => 'Ada data yang belum diisi']);
                }

                $itemFile = new TrxDataFile();
                $itemFile->nama_file = $data['nama_file'];
                $itemFile->keterangan = $data['keterangan'];
                $itemFile->tahun = $data['tahun'];
                $itemFile->tempat = $data['tempat'];
                $itemFile->penanggung_jawab = $data['penanggung_jawab'];
    
                $itemFile->id_data_klasifikasi = $data['id_data_klasifikasi'];
                $itemFile->id_data_sub_klasifikasi = $data['id_data_sub_klasifikasi'];
                $itemFile->id_data_kategori = $data['id_data_kategori'];
                $itemFile->id_data_instansi = $data['id_data_instansi'];

                $itemFile->akses = $data['akses'];
                $itemFile->bentuk = $data['bentuk'];
    
                $itemFile->created_by = auth()->user()->name;
                $itemFile->save();
                $itemFile = $itemFile->fresh();
    
                $tempFile = TemporaryFile::where('folder', $request->data_file)->first();
    
                if ($tempFile) {
                    $url = storage_path('app/public/data_file/tmp/' . $tempFile->folder . '/' . $tempFile->filename);
                    $ext = pathinfo($url, PATHINFO_EXTENSION);
                    $itemFile->addMedia($url)
                                ->usingName($request->nama_file)
                                ->usingFileName($request->nama_file . '.' . $ext)
                                ->toMediaCollection('data_file');
                    rmdir(storage_path('app/public/data_file/tmp/' . $tempFile->folder));
                    $tempFile->delete();
    
                    $mediaFile = $itemFile->getMedia('data_file');
                    $itemFile->update([
                        'url_file'  => $mediaFile[0]->getUrl(),
                        'ext'       => $ext
                    ]);
                }
            }

            if(isset($request->upload_file)) {
                $tempFile = TemporaryFile::where('folder', $request->data_file)->first();
    
                if ($tempFile) {
                    $url = storage_path('app/public/data_file/tmp/' . $tempFile->folder . '/' . $tempFile->filename);
                    $ext = pathinfo($url, PATHINFO_EXTENSION);
                    $itemFile->addMedia($url)
                                ->usingName($request->nama_file)
                                ->usingFileName($request->nama_file . '.' . $ext)
                                ->toMediaCollection('data_file');
                    rmdir(storage_path('app/public/data_file/tmp/' . $tempFile->folder));
                    $tempFile->delete();
    
                    $mediaFile = $itemFile->getMedia('data_file');
                    $itemFile->update([
                        'url_file'  => $mediaFile[0]->getUrl(),
                        'ext'       => $ext
                    ]);
                }
            }
            
            
            $success = true;
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return response()
            ->json(['success' => $success, 'message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
