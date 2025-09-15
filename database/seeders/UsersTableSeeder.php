<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Log;
use Illuminate\Support\Facades\Artisan;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();


        $data = [
            ['name' => 'PRAMANA YUDA', 'username' => '199407292022031002', 'email' => '199407292022031002@kemenag.go.id', 'password' => Hash::make('1000kali'), 'plain_password' => '1000kali', 'current_role_id' => 1, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 0],
            ['name' => 'RHAMA EKA PUTRA', 'username' => '198605082011011013', 'email' => '198605082011011013@kemenag.go.id', 'password' => Hash::make('rhama123'), 'plain_password' => 'rhama123', 'current_role_id' => 2, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 0],

            ['name' => 'ERI GUSNEDI', 'username' => '197807302007011009', 'email' => '197807302007011009@kemenag.go.id', 'password' => Hash::make('erigusnedi123'), 'plain_password' => 'erigusnedi123', 'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 0],
            ['name' => 'RISNA YANTI', 'username' => '198007022005012012', 'email' => '198007022005012012@kemenag.go.id', 'password' => Hash::make('risnayanti123'), 'plain_password' => 'risnayanti123', 'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 0],
            ['name' => 'VETHRIA RAHMI', 'username' => '198110082007012016', 'email' => '198110082007012016@kemenag.go.id', 'password' => Hash::make('vethiarahmi123'), 'plain_password' => 'vethiarahmi123', 'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 0],
            ['name' => 'FITRA DEWI', 'username' => '198512082005012001', 'email' => '198512082005012001@kemenag.go.id', 'password' => Hash::make('fitradewi123'), 'plain_password' => 'fitradewi123', 'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 0],
            ['name' => 'RIZKI RONALDI', 'username' => '198203092009011007', 'email' => '198203092009011007@kemenag.go.id', 'password' => Hash::make('rizkironaldi123'), 'plain_password' => 'rizkironaldi123', 'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 0],


            // Admin Daerah
            [
                'name' => 'Adm Kepulauan Mentawai',
                'username' => 'adm.kepulauanmentawai',
                'email' => 'adm.kepulauanmentawai@kemenag.go.id',
                'password' => Hash::make('adm.kepulauanmentawai'), 'plain_password' => 'adm.kepulauanmentawai',
                'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 1301
            ],
            [
                'name' => 'Adm Pesisir Selatan',
                'username' => 'adm.pesisirselatan',
                'email' => 'adm.pesisirselatan@kemenag.go.id',
                'password' => Hash::make('adm.pesisirselatan'), 'plain_password' => 'adm.pesisirselatan',
                'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 1302
            ],
            [
                'name' => 'Adm Kabupaten Solok',
                'username' => 'adm.kabsolok',
                'email' => 'adm.kabsolok@kemenag.go.id',
                'password' => Hash::make('adm.kabsolok'), 'plain_password' => 'adm.kabsolok',
                'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 1303
            ],
            [
                'name' => 'Adm Sijunjung',
                'username' => 'adm.sijunjung',
                'email' => 'adm.sijunjung@kemenag.go.id',
                'password' => Hash::make('adm.sijunjung'), 'plain_password' => 'adm.sijunjung',
                'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 1304
            ],
            [
                'name' => 'Adm Tanah Datar',
                'username' => 'adm.tanahdatar',
                'email' => 'adm.tanahdatar@kemenag.go.id',
                'password' => Hash::make('adm.tanahdatar'), 'plain_password' => 'adm.tanahdatar',
                'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 1305
            ],
            [
                'name' => 'Adm Padang Pariaman',
                'username' => 'adm.padangpariaman',
                'email' => 'adm.padangpariaman@kemenag.go.id',
                'password' => Hash::make('adm.padangpariaman'), 'plain_password' => 'adm.padangpariaman',
                'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 1306
            ],
            [
                'name' => 'Adm Agam',
                'username' => 'adm.agam',
                'email' => 'adm.agam@kemenag.go.id',
                'password' => Hash::make('adm.agam'), 'plain_password' => 'adm.agam',
                'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 1307
            ],
            [
                'name' => 'Adm Lima Puluh Kota',
                'username' => 'adm.limapuluhkota',
                'email' => 'adm.limapuluhkota@kemenag.go.id',
                'password' => Hash::make('adm.limapuluhkota'), 'plain_password' => 'adm.limapuluhkota',
                'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 1308
            ],
            [
                'name' => 'Adm Pasaman',
                'username' => 'adm.pasaman',
                'email' => 'adm.pasaman@kemenag.go.id',
                'password' => Hash::make('adm.pasaman'), 'plain_password' => 'adm.pasaman',
                'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 1309
            ],
            [
                'name' => 'Adm Solok Selatan',
                'username' => 'adm.solokselatan',
                'email' => 'adm.solokselatan@kemenag.go.id',
                'password' => Hash::make('adm.solokselatan'), 'plain_password' => 'adm.solokselatan',
                'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 1310
            ],
            [
                'name' => 'Adm Dharmasraya',
                'username' => 'adm.dharmasraya',
                'email' => 'adm.dharmasraya@kemenag.go.id',
                'password' => Hash::make('adm.dharmasraya'), 'plain_password' => 'adm.dharmasraya',
                'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 1311
            ],
            [
                'name' => 'Adm Pasaman Barat',
                'username' => 'adm.pasamanbarat',
                'email' => 'adm.pasamanbarat@kemenag.go.id',
                'password' => Hash::make('adm.pasamanbarat'), 'plain_password' => 'adm.pasamanbarat',
                'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 1312
            ],
            [
                'name' => 'Adm Padang',
                'username' => 'adm.padang',
                'email' => 'adm.padang@kemenag.go.id',
                'password' => Hash::make('adm.padang'), 'plain_password' => 'adm.padang',
                'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 1371
            ],
            [
                'name' => 'Adm Kota Solok',
                'username' => 'adm.kotasolok',
                'email' => 'adm.kotasolok@kemenag.go.id',
                'password' => Hash::make('adm.kotasolok'), 'plain_password' => 'adm.kotasolok',
                'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 1372
            ],
            [
                'name' => 'Adm Sawah Lunto',
                'username' => 'adm.sawahlunto',
                'email' => 'adm.sawahlunto@kemenag.go.id',
                'password' => Hash::make('adm.sawahlunto'), 'plain_password' => 'adm.sawahlunto',
                'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 1373
            ],
            [
                'name' => 'Adm Padang Panjang',
                'username' => 'adm.padangpanjang',
                'email' => 'adm.padangpanjang@kemenag.go.id',
                'password' => Hash::make('adm.padangpanjang'), 'plain_password' => 'adm.padangpanjang',
                'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 1374
            ],
            [
                'name' => 'Adm Bukittinggi',
                'username' => 'adm.bukittinggi',
                'email' => 'adm.bukittinggi@kemenag.go.id',
                'password' => Hash::make('adm.bukittinggi'), 'plain_password' => 'adm.bukittinggi',
                'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 1375
            ],
            [
                'name' => 'Adm Payakumbuh',
                'username' => 'adm.payakumbuh',
                'email' => 'adm.payakumbuh@kemenag.go.id',
                'password' => Hash::make('adm.payakumbuh'), 'plain_password' => 'adm.payakumbuh',
                'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 1376
            ],
            [
                'name' => 'Adm Pariaman',
                'username' => 'adm.pariaman',
                'email' => 'adm.pariaman@kemenag.go.id',
                'password' => Hash::make('adm.pariaman'), 'plain_password' => 'adm.pariaman',
                'current_role_id' => 3, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'id_kabkota' => 1377
            ],


        ];


        foreach ($data as $key => $item) {
            \App\Models\User::firstOrCreate(
                ['username' => $item['username']],
                $item
            );
        }
    }
}
