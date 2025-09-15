<?php

namespace App\Http\Controllers;

use App\Models\RefDataInstansi;
use App\Models\RefDataKategori;
use App\Models\Tag;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function addKategori(Request $request)
    {

        $success = false;
        $message = '';

        try {
            $name = $request->kategori_name;

            $newKategori = new RefDataKategori();
            $newKategori->name = $name;
            $newKategori->save();

            $newKategori->fresh();
            $data = $newKategori;

            $success = true;
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return response()
            ->json([
                'data'    => $data,
                'success' => $success,
                'message' => $message
            ]);
    }

    public function addInstansi(Request $request)
    {

        $success = false;
        $message = '';

        try {
            $name = $request->instansi_name;

            $newInstansi = new RefDataInstansi();
            $newInstansi->name = $name;
            $newInstansi->save();

            $newInstansi->fresh();
            $data = $newInstansi;

            $success = true;
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return response()
            ->json([
                'data'    => $data,
                'success' => $success,
                'message' => $message
            ]);
    }

    public function addTag(Request $request)
    {

        $success = false;
        $message = '';

        try {
            $name = $request->tag_name;

            $newTag = new Tag();
            $newTag->name = \Str::ucfirst($name);
            $newTag->slug = \Str::slug($name);
            $newTag->keywords = '';
            $newTag->meta_desc = '';
            $newTag->save();

            $newTag->fresh();
            $data = $newTag;

            $success = true;
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return response()
            ->json([
                'data'    => $data,
                'success' => $success,
                'message' => $message
            ]);
    }
}
