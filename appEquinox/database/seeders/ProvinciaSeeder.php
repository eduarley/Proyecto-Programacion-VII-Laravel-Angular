<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        $provincia = new \App\Models\Provincia();
        $provincia->descripcion = "San José";
        $provincia->save();
        //2
        $provincia = new \App\Models\Provincia();
        $provincia->descripcion = "Alajuela";
        $provincia->save();
        //3
        $provincia = new \App\Models\Provincia();
        $provincia->descripcion = "Cartago";
        $provincia->save();
        //4
        $provincia = new \App\Models\Provincia();
        $provincia->descripcion = "Heredia";
        $provincia->save();
        //5
        $provincia = new \App\Models\Provincia();
        $provincia->descripcion = "Guanacaste";
        $provincia->save();
        //6
        $provincia = new \App\Models\Provincia();
        $provincia->descripcion = "Puntarenas";
        $provincia->save();
        //7
        $provincia = new \App\Models\Provincia();
        $provincia->descripcion = "Limón";
        $provincia->save();
    }
}
