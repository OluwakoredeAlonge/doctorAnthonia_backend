<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@drsoje.com'],
            [
                'name'         => 'Dr. Mrs. Anthonia Yemisi Soje',
                'display_name' => 'Dr. A.Y. Soje',
                'email'        => 'admin@drsoje.com',
                'phone'        => '+2348000000000',
                'password'     => Hash::make('Admin@2025'),
            ]
        );
    }
}
