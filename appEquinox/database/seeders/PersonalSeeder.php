<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PersonalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        $personal = new \App\Models\Personal();
        $personal->nombre = 'Steven';
        $personal->apellido = 'Moya';
        $personal->correo = 'sm@gmail.com';
        $personal->telefono = '80524635';
        $personal->estado = true;
        $personal->vehiculo_id = 1;
        $personal->save();

        //2
        $personal = new \App\Models\Personal();
        $personal->nombre = 'Jean Carlos';
        $personal->apellido = 'Ramirez';
        $personal->correo = 'jcr@gmail.com';
        $personal->telefono = '75214568';
        $personal->estado = true;
        $personal->vehiculo_id = 3;
        $personal->save();

        //3
        $personal = new \App\Models\Personal();
        $personal->nombre = 'Carlos';
        $personal->apellido = 'Quirós';
        $personal->correo = 'cq@gmail.com';
        $personal->telefono = '60745231';
        $personal->estado = false;
        $personal->vehiculo_id = 2;
        $personal->save();

        //4
        $personal = new \App\Models\Personal();
        $personal->nombre = 'Ramón';
        $personal->apellido = 'Segura Valverde';
        $personal->correo = 'rsv@gmail.com';
        $personal->telefono = '86102375';
        $personal->estado = true;
        $personal->vehiculo_id = 4;
        $personal->save();
    }
}
