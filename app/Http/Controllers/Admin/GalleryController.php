<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;

class GalleryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // baca filter dari query string
            $type = $request->query('type', null);

            // mulai query
            $query = Gallery::query();

            // jika ada filter type dan bukan empty string
            if (!empty($type)) {
                $query->where('type', $type);
            }

            // ambil collection (kamu bisa ubah ke server-side later jika butuh)
            $galleries = $query->get();

            return DataTables::of($galleries)
                ->addIndexColumn()
                ->addColumn('action', function ($gallery) {
                    $btn = '';
                    $btn .= '<button id="editBtn" type="button" class="btn btn-sm btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#tambahGroup" data-bs-title="Edit Data" data-title="Edit Data Pengguna"><i class="bi bi-pencil-square"></i></button>&nbsp;';

                    if ($gallery->featured == 'no') {
                        $btn .= '<button id="destroyBtn" type="button" class="btn btn-sm btn-danger btn-xs" data-bs-id_gallery="' . $gallery->id_gallery  . '" data-id_gallery="' .  $gallery->id_gallery  . '"><i class="bi bi-trash-fill"></i></button>';
                    }
                    return $btn;
                })
                ->addColumn('image_url_can', function ($gallery) {
                    $img = $gallery->image_url;
                    if ($img) {
                        $html = '<div class="profile-edit">
                                    <img class="profile-edit" id="profile_photo_jst" src="' . $img . '" alt="None">
                                </div>';
                    } else {
                        $html = '-';
                    }
                    return $html;
                })
                ->addColumn('name-description', function ($gallery) {
                    $bgtobe = 'bg-warning';

                    switch ($gallery->type) {
                        case 'foto':
                            $bgtobe = 'bg-success';
                            break;

                        case 'video':
                            $bgtobe = 'bg-warning';
                            break;

                        case 'ebook':
                            $bgtobe = 'bg-secondary';
                            break;
                        case 'ekoran':
                            $bgtobe = 'bg-primary';
                            break;
                        default:
                            break;
                    }

                    $text = '<span style="font-size:larger; font-weight:bolder;">' . $gallery->title . '
                    </span>&nbsp;&nbsp; <span class="badge ' . $bgtobe  . '"><i>' . $gallery->type . '</i></span>
                    </span>&nbsp;&nbsp; <span class="badge bg-info"><i>' . $gallery->filter_tag . '</i></span><br>
                            <span class="text-muted preserveLines" style="font-size:smaller">' . $gallery->description . ' </span>';
                    return $text;
                })
                ->addColumn('content', function ($gallery) {
                    $img = $gallery->image_url;
                    if ($img) {
                        $html = '<div class="profile-edit">
                                    <img class="profile-edit" id="profile_photo_jst" src="' . $img . '" alt="None">
                                </div>';
                    } else {
                        $html = '-';
                    }
                    return $html;
                })
                ->rawColumns(['action', 'image_url_can', 'content', 'name-description'])
                ->make(true);
        }

        // non-ajax: render view
        return view('admin.gallery.index', [
            'title' => 'Gallery List',
            'br1' => 'Dashboard',
            'br2' => 'Gallery'
        ]);
    }


    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $galleries = Gallery::get();

    //         return DataTables::of($galleries)
    //             ->addIndexColumn()
    //             ->addColumn('action', function ($gallery) {
    //                 $btn = '';
    //                 $btn .= '<button id="editBtn" type="button" class="btn btn-sm btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#tambahGroup" data-bs-title="Edit Data" data-title="Edit Data Pengguna"><i class="bi bi-pencil-square"></i></button>&nbsp;';

    //                 if ($gallery->featured == 'no') {
    //                     $btn .= '<button id="destroyBtn" type="button" class="btn btn-sm btn-danger btn-xs" data-bs-id_gallery="' . $gallery->id_gallery  . '" data-id_gallery="' .  $gallery->id_gallery  . '"><i class="bi bi-trash-fill"></i></button>';
    //                 }
    //                 return $btn;
    //             })
    //             ->addColumn('image_url_can', function ($gallery) {
    //                 $img = $gallery->image_url;
    //                 if ($img) {
    //                     $html = '<div class="profile-edit">
    //                                 <img class="profile-edit" id="profile_photo_jst" src="' . $img . '" alt="None">
    //                             </div>';
    //                 } else {
    //                     $html = '-';
    //                 }
    //                 return $html;
    //             })
    //             ->addColumn('name-description', function ($gallery) {
    //                 $bgtobe = 'bg-warning';

    //                 switch ($gallery->type) {
    //                     case 'foto':
    //                         $bgtobe = 'bg-success';
    //                         break;

    //                     case 'video':
    //                         $bgtobe = 'bg-warning';
    //                         break;

    //                     case 'ebook':
    //                         $bgtobe = 'bg-secondary';
    //                         break;
    //                     default:
    //                         # code...
    //                         break;
    //                 }

    //                 $text = '<span style="font-size:larger; font-weight:bolder;">' . $gallery->title . '
    //                 </span>&nbsp;&nbsp; <span class="badge ' . $bgtobe  . '"><i>' . $gallery->type . '</i></span>
    //                 </span>&nbsp;&nbsp; <span class="badge bg-info"><i>' . $gallery->filter_tag . '</i></span><br>
    //                         <span class="text-muted preserveLines" style="font-size:smaller">' . $gallery->description . ' </span>';
    //                 return $text;
    //             })
    //             ->addColumn('content', function ($gallery) {
    //                 $img = $gallery->image_url;
    //                 if ($img) {
    //                     $html = '<div class="profile-edit">
    //                                 <img class="profile-edit" id="profile_photo_jst" src="' . $img . '" alt="None">
    //                             </div>';
    //                 } else {
    //                     $html = '-';
    //                 }
    //                 return $html;
    //             })
    //             ->rawColumns(['action', 'image_url_can', 'content', 'name-description'])
    //             ->make(true);
    //     }


    //     return view('admin.gallery.index', [
    //         'title'  => 'Gallery',
    //         'br1'  => 'Pengelolaan',
    //         'br2'  => 'Gallery',
    //     ]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $success = 'nope';
        $message = '';
        $code = 400;

        // ambil input dengan default
        $idGallery = $request->input('id_gallery', '');
        $title = $request->input('title', '');
        $filterTag = $request->input('filter_tag', '');
        $alt = $request->input('alt', '');
        $deskripsi = $request->input('deskripsi', '');
        $type = $request->input('type', '');
        $url = $request->input('url', '');

        // Persiapkan variabel cover hanya jika ada data cover baru
        $cover = null;
        $coverPublicId = $request->input('cover_public_id', null);

        try {
            // jika ada cover baru diterima dari request -> buat payload & encrypt
            if (!empty($coverPublicId)) {
                $payload = [
                    'public_id'   => $coverPublicId,
                    'version'     => $request->input('cover_version') ?: null,
                    'ext'         => $request->input('cover_ext') ?: null,
                    'uploaded_at' => now()->toDateTimeString(),
                ];
                $cover = Crypt::encryptString(json_encode($payload));
            }

            if ($idGallery === '' || $idGallery === null) {
                // create new
                $gallery = new Gallery();
                $gallery->title = $title;
                $gallery->filter_tag = $filterTag;
                $gallery->image_url = $cover; // bisa null jika tidak ada cover
                $gallery->alt = $alt;
                $gallery->description = $deskripsi;
                $gallery->type = $type;
                $gallery->url = $url;
                $gallery->save();
            } else {
                // update existing
                $fGallery = Gallery::find($idGallery);

                if (!$fGallery) {
                    throw new \Exception("Gallery with id {$idGallery} not found.");
                }

                $fGallery->title = $title;
                $fGallery->filter_tag = $filterTag;

                // Hanya replace image_url kalau ada cover baru; kalau tidak, biarkan tetap
                if ($cover !== null) {
                    $fGallery->image_url = $cover;
                }

                $fGallery->alt = $alt;
                $fGallery->description = $deskripsi;
                $fGallery->type = $type;
                $fGallery->url = $url;
                $fGallery->save();
            }

            $success = 'yeah';
            $code = 200;
            $message = 'Data Berhasil Disimpan';
        } catch (\Throwable $th) {
            // optional: log error
            \Log::error('Gallery store error: '.$th->getMessage(), [
                'trace' => $th->getTraceAsString()
            ]);
            $message = $th->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
            'code' => $code,
        ], $code);
    }
}
