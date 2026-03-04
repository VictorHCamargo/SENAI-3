<?php

namespace App\Models;

use App\Models\Fornecedores;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;


    protected $fillable = [
        "produto_id", 
        "fornecedor_id",
        "item",
        "unidade_medida",
        "quantidade_atual",
        "quantidade_minima",
        "valor_unitario",
        "localizacao"
    ];

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedores::class, 'fornecedor_id');
    }
}
