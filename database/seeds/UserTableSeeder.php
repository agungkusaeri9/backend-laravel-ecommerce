<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name' => 'Acep RPL',
            'username' => 'aceprpl12',
            'email' => 'aceprpl@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('user'),
            'phone_number' => '081923112312',
            'remember_token' => Str::random(50),
            'avatar' => NULL
        ]);
        $user2 = User::create([
            'name' => 'Deni RPL',
            'username' => 'deni12',
            'email' => 'deni@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('user'),
            'phone_number' => '08199231233',
            'remember_token' => Str::random(50),
            'avatar' => NULL
        ]);

        $user1->assignRole('user');
        $user2->assignRole('user');
    }
}
