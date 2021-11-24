<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'ashish',
            'email' => 'ashish.shakya@introcept.co',
            'password' => Hash::make('TestP@ssword#1234'), // password
            'is_admin' => 0,
            'department_id' => 2
        ]);
    }
}
