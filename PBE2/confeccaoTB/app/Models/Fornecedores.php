<?php

namespace App\Models;

use App\Models\Estoque;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedores extends Model
{
    use HasFactory;

    protected $fillable = [
        "nome_fantasia", 
        "razao_social", 
        "cnpj", 
        "email", 
        "telefone", 
        "categoria", 
        "endereco"
    ];

    public function estoque()
    {
        return $this->hasMany(Estoque::class, 'cliente_id');
    }
}