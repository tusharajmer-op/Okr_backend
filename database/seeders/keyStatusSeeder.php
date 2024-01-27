<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\keyStatus;

class keyStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $keyStatus = [
            ['name' => 'Not Started'],
            ['name' => 'On Track'],
            ['name' => 'At Risk'],
            ['name' => 'In Trouble'],
            ['name' => 'Completed'],
            ['name' => 'Archived']
        ];
        foreach ($keyStatus as $keyStatus) {
            keyStatus::create($keyStatus);
        }
    }
}
