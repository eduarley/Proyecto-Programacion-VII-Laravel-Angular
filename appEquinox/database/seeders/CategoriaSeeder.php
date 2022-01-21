<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        $categoria = new \App\Models\Categoria();
        $categoria->descripcion = "Viento";
        $categoria->save();
        //2
        $categoria = new \App\Models\Categoria();
        $categoria->descripcion = "Cuerda";
        $categoria->save();
        //3
        $categoria = new \App\Models\Categoria();
        $categoria->descripcion = "Percusión";
        $categoria->save();
        //4
        $categoria = new \App\Models\Categoria();
        $categoria->descripcion = "Instrumentos eléctrico";
        $categoria->save();
        //5
        $categoria = new \App\Models\Categoria();
        $categoria->descripcion = "Instrumentos acústicos";
        $categoria->save();
    }
}
