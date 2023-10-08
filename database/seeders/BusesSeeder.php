<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Bus::create([
            'driver' => 'Driver 1',
            'capacity' => 4,
            'plate' => 'RAF000A',
        ]);
    }
}
