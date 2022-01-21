<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pedido_id');
            $table->unsignedInteger('producto_id');
            $table->unsignedTinyInteger('cantidad')->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->timestamps();


            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('pedido_id')->references('id')->on('pedidos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalle_pedidos', function (Blueprint $table) {
            $table->dropForeign('detalle_pedidos_producto_id_foreign');
            $table->dropForeign('detalle_pedidos_pedido_id_foreign');
        });
        Schema::dropIfExists('detalle_pedidos');
    }
}
