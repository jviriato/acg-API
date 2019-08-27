<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;

class AlunoController extends Controller
{
    public function index()
    {
        $data = Aluno::with('curso')->get();

        return response()->json([$data], 200);
    }
}
