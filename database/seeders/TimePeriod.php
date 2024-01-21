<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimePeriod extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for($year = 2022; $year <= 2028; $year++){
            for($quarter = 1; $quarter <= 4; $quarter++){
                \DB::table('time_period')->insert([
                    'year' => $year,
                    'quarter' => 'q' . $quarter,
                ]);
            }
        }

    }
}
