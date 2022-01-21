<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        $marca = new \App\Models\Marca();
        $marca->descripcion = 'Fender';
        $marca->save();
        //2
        $marca = new \App\Models\Marca();
        $marca->descripcion = 'Yamaha';
        $marca->save();
        //3
        $marca = new \App\Models\Marca();
        $marca->descripcion = 'Ibanez';
        $marca->save();
        //4
        $marca = new \App\Models\Marca();
        $marca->descripcion = 'Pearl';
        $marca->save();
        //5
        $marca = new \App\Models\Marca();
        $marca->descripcion = 'Gibson';
        $marca->save();
        //6
        $marca = new \App\Models\Marca();
        $marca->descripcion = 'Mapex';
        $marca->save();
        //7
        $marca = new \App\Models\Marca();
        $marca->descripcion = 'Sonor';
        $marca->save();
        //8
        $marca = new \App\Models\Marca();
        $marca->descripcion = 'Roland';
        $marca->save();
        //9
        $marca = new \App\Models\Marca();
        $marca->descripcion = 'William Lewis';
        $marca->save();
        //10
        $marca = new \App\Models\Marca();
        $marca->descripcion = 'TYCOON';
        $marca->save();
        //11
        $marca = new \App\Models\Marca();
        $marca->descripcion = 'BUFFET';
        $marca->save();
        //12
        $marca = new \App\Models\Marca();
        $marca->descripcion = 'CONN';
        $marca->save();
    }
}
