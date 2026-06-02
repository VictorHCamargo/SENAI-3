<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    // Mantém a compatibilidade com o Spatie e permite customizações futuras
    protected $guarded = [];
}