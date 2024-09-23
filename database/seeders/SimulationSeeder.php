<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SimulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('simulations')->insert([
            'nome' =>'joão',
            'sobrenome' => 'simão',
            'endereco'  => 'rua x, avenida x, casa nº30',
            'cidade'  => 'são josé dos campos',
            'estado'  => 'SÃO PAULO',
            'cep'  => '1234-03',
            'score'  => 12,
            'status'  => 'reprovado',
            'car_id'  => 1,

        ]);

    }
}
