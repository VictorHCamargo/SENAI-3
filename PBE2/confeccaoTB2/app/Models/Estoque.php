<?php

namespace App\Models;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $guarded = [];

    public function produto() {
        return $this->belongsTo(Produto::class);
    }
}
