<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{
    public function index() 
    {
        $data = Curso::get();

        return response()->json([$data], 200);
    }
}
