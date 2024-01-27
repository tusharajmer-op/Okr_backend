<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CheckInFrequency;

class CheckInFrequencies extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CheckInFrequency::create([
            'name' => 'Every Day', 
        ]);
        CheckInFrequency::create([
            'name' => 'Every Monday', 
        ]);
        CheckInFrequency::create([
            'name' => 'Every Tuesday', 
        ]);
        CheckInFrequency::create([
            'name' => 'Every Wednesday', 
        ]);
        CheckInFrequency::create([
            'name' => 'Every Thursday', 
        ]);
        CheckInFrequency::create([
            'name' => 'Every Friday', 
        ]);
        CheckInFrequency::create([
            'name' => 'Every Saturday', 
        ]);
        CheckInFrequency::create([
            'name' => 'Every Sunday', 
        ]);
        CheckInFrequency::create([
            'name' => 'Last Day of the Month', 
        ]);

    }
}
