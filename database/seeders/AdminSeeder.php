<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        Admin::create([
            'name' => 'Admin Name',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'status' => 1,
            'password' => Hash::make('admin'),
        ]);
    }
}