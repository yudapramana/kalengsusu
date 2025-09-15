<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Log;

class DataFileRawDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Schema::drop('trx_data_file');
        $path = public_path('sql/trx_data_file.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);
        
    }
}
