<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Agung Kusaeri',
            'username' => 'agungkusaeri17',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'phone_number' => '081929912312',
            'remember_token' => Str::random(50),
            'avatar' => NULL
        ]);
        $admin->assignRole('admin');
    }
}
