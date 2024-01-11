<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
class AdminDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $department = Department::create([
            'name' => 'Admin',
            'description' => 'Admin Department',
            'short_name' => 'Admin'
        ]);
    }
}
