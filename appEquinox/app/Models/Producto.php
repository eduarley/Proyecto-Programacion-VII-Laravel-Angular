<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'descripcion', 'precio', 'marca_id', 'categoria_id'
    ];

    public function marca()
    {
        return $this->belongsTo('App\Models\Marca');
    }
    /*
    public function detallePedidos()
    {
        return $this->hasMany('App\Models\DetallePedido');
    }*/
    public function pedidos()
    {
        return $this->belongsToMany('App\Models\Pedido', 'detalle_pedidos', 'producto_id', 'pedido_id')->withPivot('cantidad', 'total')->withTimestamps();
    }
    public function categorias()
    {
        return $this->belongsToMany('App\Models\Categoria');
    }
}
