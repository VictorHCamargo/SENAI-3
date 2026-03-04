<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome', 
        'sku', 
        'descricao', 
        'tamanho', 
        'cor', 
        'tecido', 
        'preco_venda', 
        'ativo'
    ];

    // Relacionamento com o Estoque (conforme conversamos anteriormente)
    public function estoque()
    {
        return $this->hasOne(Estoque::class);
    }
}
