<?php

use App\TransactionStatus;
use Illuminate\Database\Seeder;

class TransactionStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionStatus::create([
            'name' => 'Berhasil'
        ]);
        TransactionStatus::create([
            'name' => 'Sedang Dikirim'
        ]);
        TransactionStatus::create([
            'name' => 'Menunggu Dikirim'
        ]);
        TransactionStatus::create([
            'name' => 'Pembayaran Sukses'
        ]);
        TransactionStatus::create([
            'name' => 'Menunggu Pembayaran'
        ]);
        TransactionStatus::create([
            'name' => 'Gagal'
        ]);
    }
}
