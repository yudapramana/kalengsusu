<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('data_file')) {
            $file = $request->file('data_file');
            $extension = $file->getClientOriginalExtension();
            $filename  = $file->getClientOriginalName();
            $folder    = uniqid() . '-'. now()->timestamp;
            $file->storeAs('data_file/tmp/' . $folder, $filename);


            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename,
            ]);

            return $folder;
        }

        return '';
    }

    public function destroy(Request $request, $id)
    {
        $folder = $request->getContent();
        $this->rmdir_recursive(storage_path('app/public/data_file/tmp/' . $folder));

        $tempFile = TemporaryFile::where('folder', $folder)->first();
        if ($tempFile) {
            $tempFile->delete();
        }

        return $folder;
    }


    public function rmdir_recursive($dir) {
        foreach(scandir($dir) as $file) {
            if ('.' === $file || '..' === $file) continue;
            if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
            else unlink("$dir/$file");
        }
        rmdir($dir);
    }
}
