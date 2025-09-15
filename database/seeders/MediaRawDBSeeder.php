<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Log;

class MediaRawDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Schema::drop('media');
        $path = public_path('sql/media.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);

        
    }
}
