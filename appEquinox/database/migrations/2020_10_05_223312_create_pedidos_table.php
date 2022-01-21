<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula_cliente');
            $table->string('nombre_completo_cliente');
            $table->string('telefono_cliente');
            $table->string('tipo_pedido');
            $table->date('fecha');
            $table->string('direccion');
            $table->decimal("subtotal", 10, 2)->nullable();
            $table->decimal("impuesto", 10, 2)->nullable();
            $table->decimal("envio", 10, 2)->nullable();
            $table->decimal("total", 10, 2)->nullable();
            $table->string('estado');
            $table->unsignedInteger('provincia_id');
            $table->unsignedInteger('personal_id')->nullable();
            $table->timestamps();

            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->foreign('personal_id')->references('id')->on('personals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign('pedidos_provincia_id_foreign');
        });
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign('pedidos_personal_id_foreign');
        });
        Schema::dropIfExists('pedidos');
    }
}
