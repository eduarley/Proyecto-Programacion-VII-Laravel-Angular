<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //1
        $objetoUsuario = \App\Models\User::create([
            'name' => 'Josue Marchena',
            'email' => 'jm@gmail.com',
            'password' => bcrypt('123456'),
            'rol_id' => 1,
            'estado' => true
        ]);
        $objetoUsuario->save();
        //2
        $objetoUsuario = \App\Models\User::create([
            'name' => 'Eduardo Arley',
            'email' => 'ea@gmail.com',
            'password' => bcrypt('123456'),
            'rol_id' => 2,
            'estado' => true
        ]);
        $objetoUsuario->save();
        //3
        $objetoUsuario = \App\Models\User::create([
            'name' => 'Saturnino Hidalgo',
            'email' => 'sh@gmail.com',
            'password' => bcrypt('123456'),
            'rol_id' => 3,
            'estado' => true
        ]);
        $objetoUsuario->save();
    }
}
