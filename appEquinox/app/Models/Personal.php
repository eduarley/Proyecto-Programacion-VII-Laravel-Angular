<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    public function pedidos()
    {
        return $this->hasMany('App\Models\Pedido');
    }

    public function vehiculo()
    {
        return $this->belongsTo('App\Models\Vehiculo');
    }
}
