<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::truncate();

        Admin::insert([
            [
                'nama_admin' => 'Administrator Kelurahan Teritih',
                'username'   => 'adminteritih',
                'password'   => Hash::make('Password12345'),
            ],
            [
                'nama_admin' => 'Administartor Kelurahan',
                'username'   => 'Admin1',
                'password'   => Hash::make('Password12345'),
            ],
        ]);
    }
}