<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\keyTypes;

class KeyTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        keyTypes::create([
            'name' => 'Percentage',
        ]);
        keyTypes::create([
            'name' => 'Activity Based',
        ]);

    }
}
