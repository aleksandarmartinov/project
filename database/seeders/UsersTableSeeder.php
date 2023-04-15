<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Marko',
            'email' => 'marko@gmail.com',
            'password' => Hash::make('password'),
            'deposit' => 8000
        ]);

        User::create([
            'name' => 'Milan',
            'email' => 'milan@gmail.com',
            'password' => Hash::make('password'),
            'deposit' => 1000
        ]);

        User::create([
            'name' => 'Pera',
            'email' => 'pera@gmail.com',
            'password' => Hash::make('password'),
            'deposit' => 600
        ]);

        User::create([
            'name' => 'Sima',
            'email' => 'sima@gmail.com',
            'password' => Hash::make('password'),
            'deposit' => 5500
        ]);

        User::create([
            'name' => 'Ana',
            'email' => 'ana@gmail.com',
            'password' => Hash::make('password'),
            'deposit' => 8900
        ]);
    }
}