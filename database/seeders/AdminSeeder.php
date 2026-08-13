<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\admin\Admins;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new Admins();
        $admin->adminname = 'AdminJay';
        $admin->email = 'jay@gmail.com';
        $admin->password = Hash::make('jaypogi');
        $admin->token = '';
        $admin->save();
    }
}
