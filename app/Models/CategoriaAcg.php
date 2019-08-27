<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaAcg extends Model
{
    public $table = 'categoria_acg';

    public function curso()
    {
        return $this->hasOne('App\Models\Curso', 'id', 'id_curso');
    }
}
