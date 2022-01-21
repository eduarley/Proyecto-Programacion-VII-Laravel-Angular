<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        $rol = new \App\Models\Rol();
        $rol->descripcion = 'Administrador';
        $rol->save();
        //2
        $rol = new \App\Models\Rol();
        $rol->descripcion = 'Vendedor';
        $rol->save();
        //3
        $rol = new \App\Models\Rol();
        $rol->descripcion = 'Bodega';
        $rol->save();
    }
}
