<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    public $table = 'aluno';

    public function curso()
    {
        return $this->hasOne( 'App\Models\Curso', 'id', 'id_curso');
    }
}
