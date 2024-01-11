<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $role = Roles::create([
            'name' => 'Admin',
            'description' => 'Admin Role',
            'short_name' => 'Admin'
        ]);

    }
}
