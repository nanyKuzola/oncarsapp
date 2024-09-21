<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Populate cars'table with initials value's.
     */
    public function run(): void
    {
        //
        DB::table('cars')->insert([
            'modelo' => 'i10',
            'marca' => 'hunday',
            'cor' => 'preta',
        ]);

        DB::table('cars')->insert([
            'modelo' => 'i120',
            'marca' => 'hunday',
            'cor' => 'branco',
        ]);

        DB::table('cars')->insert([
            'modelo' => 'sportage',
            'marca' => 'Kia',
            'cor' => 'azul',
        ]);

        DB::table('cars')->insert([
            'modelo' => 'mitsubishi',
            'marca' => 'toyota',
            'cor' => 'amarillo',
        ]);
    }
}
