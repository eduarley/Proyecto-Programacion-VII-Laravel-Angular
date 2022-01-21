<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        $producto = new \App\Models\Producto();
        $producto->nombre = 'Guitarra eléctrica Fender';
        $producto->descripcion = 'Fender - Guitarra eléctrica Stratocaster American Standard';
        $producto->precio = 450000;
        $producto->estado = true;
        $producto->marca_id = 1;
        #aqui iria la imagen
        $producto->save();
        $producto->categorias()->attach([2, 4]);
        //2
        $producto = new \App\Models\Producto();
        $producto->nombre = 'Batería electrónica Roland';
        $producto->descripcion = 'TD-50KVX';
        $producto->precio = 560000;
        $producto->estado = true;
        $producto->marca_id = 8;
        #aqui iria la imagen
        $producto->save();
        $producto->categorias()->attach([3, 4]);
        //3
        $producto = new \App\Models\Producto();
        $producto->nombre = 'Violín William Lewis';
        $producto->descripcion = 'Violín William Lewis & Son "Devonshire" 1/2';
        $producto->precio = 198500;
        $producto->estado = true;
        $producto->marca_id = 9;
        #aqui iria la imagen
        $producto->save();
        $producto->categorias()->attach([2, 5]);
        //4
        $producto = new \App\Models\Producto();
        $producto->nombre = 'Cajón Tycoon';
        $producto->descripcion = 'Cajón Tycoon Legacy Series, Nogal';
        $producto->precio = 220000;
        $producto->estado = true;
        $producto->marca_id = 10;
        #aqui iria la imagen
        $producto->save();
        $producto->categorias()->attach([3, 5]);
        //5
        $producto = new \App\Models\Producto();
        $producto->nombre = 'Clarinete Buffet';
        $producto->descripcion = 'Clarinete Buffet Crampon Prodige, Si Bemol';
        $producto->precio = 637500;
        $producto->estado = true;
        $producto->marca_id = 10;
        #aqui iria la imagen
        $producto->save();
        $producto->categorias()->attach([1]);
        //6
        $producto = new \App\Models\Producto();
        $producto->nombre = 'Saxofón Conn';
        $producto->descripcion = 'Saxofón soprano Conn SC650';
        $producto->precio = 584000;
        $producto->estado = false;
        $producto->marca_id = 10;
        #aqui iria la imagen
        $producto->save();
        $producto->categorias()->attach([1]);
    }
}
