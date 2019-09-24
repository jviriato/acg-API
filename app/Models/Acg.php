<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acg extends Model
{
    public $table = 'acg';  

    public $fillable = ['id', 'id_aluno', 'id_categoria', 'horas_requisitadas', 
    'horas_efetivadas', 'local_atividade', 'data_inicial', 'data_final', 'status', 'descricao'];

    public function aluno()
    {
        return $this->hasOne('App\Models\Aluno', 'id', 'id_aluno');
    }
    
    public function categoria()
    {
        return $this->hasOne('App\Models\CategoriaAcg', 'id', 'id_categoria');
    }

    public function anexo()
    {
        return $this->hasMany('App\Models\AcgAnexo', 'id_acg', 'id');
    }
}
