<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Sadman',
            'email' => 'sadman@gmail.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Shourab',
            'email' => 'shourab.cit.bd@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
