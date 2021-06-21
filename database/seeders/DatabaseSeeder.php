<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::create([
            'name' => 'Administrator',
            'no_ktp' => '123456781234',
            'email' => 'admin@gmail.com',
            'address' => 'Pasuruan',
            'gender' => 'lk',
            'phone' => '085648989100',
            'password' => Hash::make('admin1234'),
            'role' => 'adm',
        ]);
    }
}