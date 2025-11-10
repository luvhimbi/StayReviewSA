<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'firstname' => 'Admin',
            'lastname' => 'User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'popi_consent' => true,
            'is_two_factor_enabled' => true,
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);
        User::create([
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'lecturer@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'popi_consent' => true,
            'is_two_factor_enabled' => false,
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);


    }

}
