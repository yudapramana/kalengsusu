<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->call(KotaTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(RolesTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $this->call(ProductsTableSeeder::class);
        $this->call(GalleriesTableSeeder::class);
        $this->call(CarouselsTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TestimoniesTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        // $this->call(ReservationsTableSeeder::class);
        // $this->call(SlotsTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(MenuItemsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(PostTagTableSeeder::class);

        $this->call(RefDataInstansiTableSeeder::class);
        $this->call(RefDataKategoriTableSeeder::class);
        $this->call(RefDataClassificationSeeder::class);
        // $this->call(ActivitiesTableSeeder::class);
        // $this->call(DaftarPermohonanTableSeeder::class);
        // $this->call(DataFileRawDBSeeder::class);
        // $this->call(MediaRawDBSeeder::class);


        // $this->call(TrxDataFileTableSeeder::class);
        // $this->call(MediaTableSeeder::class);
    }
}
