<?php

namespace App\Models;

use App\Models\Pedidos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;
    protected $fillable = ['nome','cpf','email','telefone','endereco'];

    public function pedidos()
    {
        return $this->hasMany(Pedidos::class, 'cliente_id');
    }
}
