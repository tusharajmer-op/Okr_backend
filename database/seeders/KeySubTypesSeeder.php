<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\keySubTypes;

class KeySubTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        keySubTypes::create([
            'name' => 'Percentage',
            'keytype_id' => 1,
        ]);
        keySubTypes::create([
            'name' => 'Milestone Tracked',
            'keytype_id' => 2,
        ]);
        keySubTypes::create([
            'name' => 'Task Tracked',
            'keytype_id' => 2,
        ]);
    }
}
