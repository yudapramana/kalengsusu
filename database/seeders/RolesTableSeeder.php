<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $super_administrator = Role::create(['name' => 'super_administrator']);
        // $administrator = Role::create(['name' => 'administrator']);
        // $staff = Role::create(['name' => 'kontributor_utama']);
        // $staff = Role::create(['name' => 'kontributor_daerah']);


        // // Super Admin
        // $user = User::where('username', '199407292022031002')->first();
        // $user->assignRole('super_administrator');

        // // Administrator
        // $user = User::where('username', '198605082011011013')->first();
        // $user->assignRole('administrator');

        // // Staff Administrator
        // $user = User::where('username', '197807302007011009')->first();
        // $user->assignRole('kontributor_utama');
        
        // $user = User::where('username', '198007022005012012')->first();
        // $user->assignRole('kontributor_utama');
        
        // $user = User::where('username', '198110082007012016')->first();
        // $user->assignRole('kontributor_utama');
        
        // $user = User::where('username', '198512082005012001')->first();
        // $user->assignRole('kontributor_utama');
        
        // $user = User::where('username', '198203092009011007')->first();
        // $user->assignRole('kontributor_utama');

        // Kontributor Daerah
        #1
        // $user = \App\Models\User::where('username', 'adm.kepulauanmentawai')->first();
        // $user->assignRole('kontributor_daerah');
        // #2
        // $user = \App\Models\User::where('username', 'adm.pesisirselatan')->first();
        // $user->assignRole('kontributor_daerah');
        #3
        $user = \App\Models\User::where('username', 'adm.kabsolok')->first();
        $user->assignRole('kontributor_daerah');
        #4
        $user = \App\Models\User::where('username', 'adm.sijunjung')->first();
        $user->assignRole('kontributor_daerah');
        #5
        $user = \App\Models\User::where('username', 'adm.tanahdatar')->first();
        $user->assignRole('kontributor_daerah');
        #6
        $user = \App\Models\User::where('username', 'adm.padangpariaman')->first();
        $user->assignRole('kontributor_daerah');
        #7
        $user = \App\Models\User::where('username', 'adm.agam')->first();
        $user->assignRole('kontributor_daerah');
        #8
        $user = \App\Models\User::where('username', 'adm.limapuluhkota')->first();
        $user->assignRole('kontributor_daerah');
        #9
        $user = \App\Models\User::where('username', 'adm.pasaman')->first();
        $user->assignRole('kontributor_daerah');
        #10
        $user = \App\Models\User::where('username', 'adm.solokselatan')->first();
        $user->assignRole('kontributor_daerah');
        #11
        $user = \App\Models\User::where('username', 'adm.dharmasraya')->first();
        $user->assignRole('kontributor_daerah');
        #12
        $user = \App\Models\User::where('username', 'adm.pasamanbarat')->first();
        $user->assignRole('kontributor_daerah');
        #13
        $user = \App\Models\User::where('username', 'adm.padang')->first();
        $user->assignRole('kontributor_daerah');
        #14
        $user = \App\Models\User::where('username', 'adm.kotasolok')->first();
        $user->assignRole('kontributor_daerah');
        #15
        $user = \App\Models\User::where('username', 'adm.sawahlunto')->first();
        $user->assignRole('kontributor_daerah');
        #16
        $user = \App\Models\User::where('username', 'adm.padangpanjang')->first();
        $user->assignRole('kontributor_daerah');
        #17
        $user = \App\Models\User::where('username', 'adm.bukittinggi')->first();
        $user->assignRole('kontributor_daerah');
        #18
        $user = \App\Models\User::where('username', 'adm.payakumbuh')->first();
        $user->assignRole('kontributor_daerah');
        #19
        $user = \App\Models\User::where('username', 'adm.pariaman')->first();
        $user->assignRole('kontributor_daerah');
        

        // Permissions
        // $permissionMenu1 = Permission::create(['name' => 'menu-dashboard']);
        // $permissionMenu2 = Permission::create(['name' => 'menu-reservations']);
        // $permissionMenu3 = Permission::create(['name' => 'menu-information']);
        // $permissionMenu4 = Permission::create(['name' => 'menu-data']);
        // $permissionMenu5 = Permission::create(['name' => 'menu-blog']);

        // $permissionPage1_1 = Permission::create(['name' => 'page-dashboard']);

        // $permissionPage2_1 = Permission::create(['name' => 'page-reservation-index']);
        // $permissionPage2_2 = Permission::create(['name' => 'page-reservation-audits']);
        // $permissionPage2_3 = Permission::create(['name' => 'page-reservation-deleted']);

        // $permissionPage3_1 = Permission::create(['name' => 'page-information-services']);
        // $permissionPage3_2 = Permission::create(['name' => 'page-information-products']);
        // $permissionPage3_3 = Permission::create(['name' => 'page-information-galleries']);
        // $permissionPage3_4 = Permission::create(['name' => 'page-information-carousels']);

        // $permissionPage4_1 = Permission::create(['name' => 'page-data-messages']);
        // $permissionPage4_2 = Permission::create(['name' => 'page-data-users']);
        // $permissionPage4_3 = Permission::create(['name' => 'page-data-roles']);

        // $permissionPage5_1 = Permission::create(['name' => 'page-blog-categories']);
        // $permissionPage5_2 = Permission::create(['name' => 'page-blog-tags']);
        // $permissionPage5_3 = Permission::create(['name' => 'page-blog-posts']);


        // $super_administrator->givePermissionTo([
        //     $permissionMenu1, $permissionMenu2, $permissionMenu3, $permissionMenu4, $permissionMenu5,
        //     $permissionPage1_1,
        //     $permissionPage2_1, $permissionPage2_2, $permissionPage2_3,
        //     $permissionPage3_1, $permissionPage3_2, $permissionPage3_3, $permissionPage3_4,
        //     $permissionPage4_1, $permissionPage4_2, $permissionPage4_3,
        //     $permissionPage5_1, $permissionPage5_2, $permissionPage5_3
        // ]);

        // $administrator->givePermissionTo([
        //     $permissionMenu1, $permissionMenu2, $permissionMenu3, $permissionMenu4, $permissionMenu5,
        //     $permissionPage1_1,
        //     $permissionPage2_1, $permissionPage2_3,
        //     $permissionPage3_1, $permissionPage3_2, $permissionPage3_3, $permissionPage3_4,
        //     $permissionPage4_1, $permissionPage4_2,
        //     $permissionPage5_3
        // ]);

        // $staff->givePermissionTo([
        //     $permissionMenu1, $permissionMenu2, $permissionMenu3, $permissionMenu4, $permissionMenu5,
        //     $permissionPage1_1,
        //     $permissionPage2_1, $permissionPage2_3,
        //     $permissionPage3_1, $permissionPage3_2, $permissionPage3_3, $permissionPage3_4,
        //     $permissionPage4_1,
        //     $permissionPage5_3
        // ]);
    }
}
