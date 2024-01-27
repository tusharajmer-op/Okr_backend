<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CascadeApproach;

class CascadeApproachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CascadeApproach::create([
            'name' => 'Assign as Objective ',
            'diagram'=>'https://cdns.profit.co/P1.68.33/app/ng/src/assets/images/krtoobj.png'
        ]);
        CascadeApproach::create([
            'name' => 'Assign as Key Result/Sub Key Result',
            'diagram'=>'https://cdns.profit.co/P1.68.33/app/ng/src/assets/images/subkr.png'
        ]);
    }
}
