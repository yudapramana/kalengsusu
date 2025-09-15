<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class ActivityController extends Controller
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
            $activities = Activity::get();

            return Datatables::of($activities)
                ->addIndexColumn()
                ->addColumn('action', function ($activity) {
                    $btn = '';
                    $btn .= '<button id="editBtn" type="button" class="btn btn-sm btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#tambahGroup" data-bs-title="Edit Data" data-title="Edit Data Pengguna"><i class="bi bi-pencil-square"></i></button>&nbsp;';
                    $btn .= '<button id="destroyBtn" type="button" class="btn btn-sm btn-danger btn-xs" data-bs-id_activity="' . $activity->id_activity  . '" data-id_activity="' .  $activity->id_activity  . '"><i class="bi bi-trash-fill"></i></button>';
                    return $btn;
                })
                ->addColumn('cover', function ($activity) {
                    $img = $activity->cover_image_url;
                    if ($img) {
                        $html = '<div class="profile-edit">
                                    <img class="profile-edit" id="profile_photo_jst" src="' . $img . '" alt="None">
                                </div>';
                    } else {
                        $html = '-';
                    }
                    return $html;
                })
                ->addColumn('name-description', function ($activity) {
                    $text = '<span style="font-size:larger; font-weight:bolder;">' . $activity->name . '</span>&nbsp;&nbsp; ' . ($activity->featured == 'yes' ? '<span class="badge bg-primary"><i>featured</i></span>' : '') . ' &nbsp;' . ($activity->listed == 'yes' ? '<span class="badge bg-info"><i>listed</i></span>' : '') . '<br>
                            <span class="text-muted preserveLines" style="font-size:smaller">' . $activity->description . ' </span>';
                    return $text;
                })
                ->addColumn('content', function ($activity) {
                    $img = $activity->content_image_url;
                    if ($img) {
                        $html = '<div class="profile-edit">
                                    <img class="profile-edit" id="profile_photo_jst" src="' . $img . '" alt="None">
                                </div>';
                    } else {
                        $html = '-';
                    }
                    return $html;
                })
                ->rawColumns(['action', 'cover', 'content', 'name-description'])
                ->make(true);
        }



        return view('admin.activity.index', [
            'title'  => 'Daftar Kegiatan',
            'br1'  => 'Pengelolaan',
            'br2'  => 'Kegiatan',
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
        $success = 'nope';
        $message = '';
        $code = 400;

        $data = $request->input();

        try {
            if ($data['id_activity'] == '') {
                $activity = new Activity();
                $activity->name = $data['nama'];
                $activity->description = $data['deskripsi'];
                $activity->date = $data['date'];

                $activity->cover_image_url = isset($data['new-cover_image_url']) ? $data['new-cover_image_url'] : '';
                $activity->save();
            } else {
                $fActivity = Activity::find($data['id_activity']);
                $fActivity->name = $data['nama'];
                $fActivity->description = $data['deskripsi'];
                $fActivity->date = $data['date'];

                $fActivity->cover_image_url = isset($data['new-cover_image_url']) ? $data['new-cover_image_url'] : '';'';
                $fActivity->save();
            }

            $success = 'yeah';
            $code = 200;
            $message = 'Data Berhasil Disimpan';
        } catch (\Throwable $th) {
            $message = $th->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
            'code' => $code,
        ], $code);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $success = false;
        $message = '';

        try {
            $res = Activity::findOrFail($id);
            $res->delete();
            $success = true;
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return response()
            ->json(['success' => $success, 'message' => $message]);
    }
}
