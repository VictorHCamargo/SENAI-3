<?php

namespace App\Models;

use App\Models\Cliente;
use App\Models\ItemPedido;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $guarded = [];


    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function itens() {
        return $this->hasMany(ItemPedido::class);
    }
}
