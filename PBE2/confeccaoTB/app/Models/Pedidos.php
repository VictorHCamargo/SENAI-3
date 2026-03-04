<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'numero_pedido',
        'descricao_itens',
        'valor_total',
        'entrada',
        'status',
        'data_entrega_prevista',
        'data_entrega_realizada',
        'observacoes'
    ];

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'cliente_id');
    }
}