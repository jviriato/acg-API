<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcgAnexo extends Model
{
    public $table = 'acg_anexo';

    public $fillable = ['id', 'id_acg', 'local_do_anexo'];
}
