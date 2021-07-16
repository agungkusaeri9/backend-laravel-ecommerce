<?php

use App\Payment;
use Illuminate\Database\Seeder;

class PaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::create([
            'name' => 'Dana',
            'number' => '081919956872',
            'desc' => 'Agung Kusaeri'
        ]);
        Payment::create([
            'name' => 'Link Aja',
            'number' => '081919956872',
            'desc' => 'Agung Kusaeri'
        ]);
        Payment::create([
            'name' => 'Gopay',
            'number' => '081919956872',
            'desc' => 'Agung Kusaeri'
        ]);
        Payment::create([
            'name' => 'Bank Mandiri',
            'number' => '1759000012312',
            'desc' => 'Agung Kusaeri'
        ]);
    }
}
