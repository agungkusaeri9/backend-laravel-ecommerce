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
        $this->call(AdminTableSeeder::class);
        $this->call(PaymentTableSeeder::class);
        $this->call(ProductCategoryTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(ShipmentTableSeeder::class);
        $this->call(TransactionStatusTableSeeder::class);
    }
}
