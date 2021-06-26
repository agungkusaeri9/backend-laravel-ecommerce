<?php

use App\Courier;
use Illuminate\Database\Seeder;

class CourierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Courier::create([
            'code' => 'jne',
            'name' => 'JNE'
        ]);
    }
}
