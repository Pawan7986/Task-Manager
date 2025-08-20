<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
        // check if admin already exists
        if (!User::where('email', 'kmr.fam07@gmail.com')->exists()) {
            User::create([
                'name' => 'Super Admin',
                'email' => 'kmr.fam07@gmail.com',
                'password' => Hash::make('admin@123'), // change to your desired default password
                'role' => 'admin', // assuming you have a 'role' column in users table
            ]);
        }
    }
}
