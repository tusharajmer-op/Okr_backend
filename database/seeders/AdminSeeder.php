<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Job;
use App\Models\Department;
use App\Models\UserRoleDepartmentMap;
use App\Models\Roles; // Add this line to import the Roles class
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
        
        $adminRole = Roles::where('name', 'Admin')->first(); 
        $adminDepartment = Department::where('name', 'Admin')->first();

        UserRoleDepartmentMap::create([
            'user_id' => $user->id,
            'department_id' => $adminDepartment->id,
            'role_id' => $adminRole->id,
        ]);
        
    }
}
