<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    /*
    public function detallePedidos()
    {
        return $this->hasMany('App\Models\DetallePedido');
    }
    */

    public function productos()
    {
        return $this->belongsToMany('App\Models\Producto', 'detalle_pedidos', 'pedido_id', 'producto_id')
        ->withPivot('cantidad', 'total')->withTimestamps();
    }

    public function factura()
    {
        return $this->belongsTo('App\Models\Factura');
    }

    public function personal()
    {
        return $this->belongsTo('App\Models\Personal');
    }

    public function provincia()
    {
        return $this->belongsTo('App\Models\Provincia');
    }
}
