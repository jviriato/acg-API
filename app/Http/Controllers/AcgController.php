<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acg;

class AcgController extends Controller
{
    public function index()
    {
        $data = Acg::with('categoria')->with('aluno')->get();

        return response()->json([$data], 200);
    }

    public function store(Request $request)
    {
        $success = Acg::create($request->except('id'));

        return response()->json(['sucesso' => $success], 200);
    }
}
