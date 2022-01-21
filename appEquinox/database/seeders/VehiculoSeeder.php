<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        $personal = new \App\Models\Vehiculo();
        $personal->placa = '570123';
        $personal->marca = 'Isuzu';
        $personal->modelo = '2002';
        $personal->tipo = 'Camión mediano';
        $personal->save();

        //2
        $personal = new \App\Models\Vehiculo();
        $personal->placa = '601245';
        $personal->marca = 'Nissan';
        $personal->modelo = '2006';
        $personal->tipo = 'Camión grande';
        $personal->save();

        //3
        $personal = new \App\Models\Vehiculo();
        $personal->placa = '608947';
        $personal->marca = 'Toyota';
        $personal->modelo = '2010';
        $personal->tipo = 'Vehículo liviano';
        $personal->save();

        //4
        $personal = new \App\Models\Vehiculo();
        $personal->placa = '512365';
        $personal->marca = 'Nissan Sentra';
        $personal->modelo = '2015';
        $personal->tipo = 'Vehículo liviano';
        $personal->save();
    }
}
