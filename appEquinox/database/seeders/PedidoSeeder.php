<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Encabezado
        //1
        $pedido1 = new \App\Models\Pedido();
        $pedido1->cedula_cliente = '503450657';
        $pedido1->nombre_completo_cliente = 'Hernán Gómez';
        $pedido1->telefono_cliente = '24573030';
        $pedido1->tipo_pedido = 'Express';
        $pedido1->fecha = '2020-10-20';
        $pedido1->direccion = '600 metros sur del PALI de Grecia';
        $pedido1->subtotal = 1010000.00;
        $pedido1->impuesto = 132470.00;
        $pedido1->envio = 9000.00;
        $pedido1->total = 1151470.00;
        $pedido1->estado = 'pendiente';
        $pedido1->provincia_id = 2;
        $pedido1->personal_id = 1;
        $pedido1->save();

        //Detalle
        //1
        $detalle1 = new \App\Models\DetallePedido();
        $detalle1->pedido_id = $pedido1->id;
        $detalle1->producto_id = 1;
        $detalle1->cantidad = 1;
        $detalle1->total = 450000.00;
        $detalle1->save();

        //2
        $detalle2 = new \App\Models\DetallePedido();
        $detalle2->pedido_id = $pedido1->id;
        $detalle2->producto_id = 1;
        $detalle2->cantidad = 1;
        $detalle2->total = 560000.00;
        $detalle2->save();



        //Encabezado
        //2
        $pedido1 = new \App\Models\Pedido();
        $pedido1->cedula_cliente = '205160234';
        $pedido1->nombre_completo_cliente = 'Anita Acosta';
        $pedido1->telefono_cliente = '24622020';
        $pedido1->tipo_pedido = 'Pasa a retirar';
        $pedido1->fecha = '2020-10-15';
        $pedido1->direccion = 'Al costado oeste del Estadio Nacional';
        $pedido1->subtotal = 198500.00;
        $pedido1->impuesto = 25805.00;
        $pedido1->envio = 0.00;
        $pedido1->total = 224305.00;
        $pedido1->estado = 'pendiente';
        $pedido1->provincia_id = 1;
        $pedido1->personal_id = 2;
        $pedido1->save();

        //Detalle
        //1
        $detalle1 = new \App\Models\DetallePedido();
        $detalle1->pedido_id = $pedido1->id;
        $detalle1->producto_id = 3;
        $detalle1->cantidad = 1;
        $detalle1->total = 198500.00;
        $detalle1->save();



        //Encabezado
        //3
        $pedido1 = new \App\Models\Pedido();
        $pedido1->cedula_cliente = '206580796';
        $pedido1->nombre_completo_cliente = 'Tania Mayela Angulo';
        $pedido1->telefono_cliente = '86214691';
        $pedido1->tipo_pedido = 'Pasa a retirar';
        $pedido1->fecha = '2020-10-12';
        $pedido1->direccion = '200 metros norte de la Basílica de los Ángeles';
        $pedido1->subtotal = 440000.00;
        $pedido1->impuesto = 57200.00;
        $pedido1->envio = 0.00;
        $pedido1->total = 497200.00;
        $pedido1->estado = 'pendiente';
        $pedido1->provincia_id = 3;
        $pedido1->personal_id = 3;
        $pedido1->save();

        //Detalle
        //1
        $detalle1 = new \App\Models\DetallePedido();
        $detalle1->pedido_id = $pedido1->id;
        $detalle1->producto_id = 4;
        $detalle1->cantidad = 2;
        $detalle1->total = 440000.00;
        $detalle1->save();




        //Encabezado
        //4
        $pedido1 = new \App\Models\Pedido();
        $pedido1->cedula_cliente = '116250121';
        $pedido1->nombre_completo_cliente = 'Allison Barrantes Bonilla';
        $pedido1->telefono_cliente = '70264281';
        $pedido1->tipo_pedido = 'Express';
        $pedido1->fecha = '2020-10-11';
        $pedido1->direccion = 'Al costado sur del Palacio de los deportes';
        $pedido1->subtotal = 1388000.00;
        $pedido1->impuesto = 181610.00;
        $pedido1->envio = 9000.00;
        $pedido1->total = 1578610.00;
        $pedido1->estado = 'pendiente';
        $pedido1->provincia_id = 4;
        $pedido1->personal_id = 3;
        $pedido1->save();

        //Detalle
        //1
        $detalle1 = new \App\Models\DetallePedido();
        $detalle1->pedido_id = $pedido1->id;
        $detalle1->producto_id = 6;
        $detalle1->cantidad = 2;
        $detalle1->total = 1168000.00;
        $detalle1->save();

        //Detalle
        //2
        $detalle1 = new \App\Models\DetallePedido();
        $detalle1->pedido_id = $pedido1->id;
        $detalle1->producto_id = 4;
        $detalle1->cantidad = 1;
        $detalle1->total = 220000.00;
        $detalle1->save();
    }
}
