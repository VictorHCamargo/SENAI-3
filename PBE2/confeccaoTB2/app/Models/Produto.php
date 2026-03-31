<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $guarded = [];

    public function estoque()
    {
        return $this->hasOne(Estoque::class);
    }
}
