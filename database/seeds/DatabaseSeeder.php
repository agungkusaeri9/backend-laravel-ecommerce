<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        // $this->call(UserTableSeeder::class);
        $this->call(PaymentTableSeeder::class);
        // $this->call(ProductCategoryTableSeeder::class);
        // $this->call(ProductTableSeeder::class);
        // $this->call(ProductGalleryTableSeeder::class);
        // $this->call(ShipmentTableSeeder::class);
        $this->call(StoreTableSeeder::class);
        $this->call(CourierTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
    }
}
