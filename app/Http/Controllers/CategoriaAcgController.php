<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaAcg;

class CategoriaAcgController extends Controller
{
    public function index()
    {
        $data = CategoriaAcg::with('curso')->get();

        return response()->json([$data], 200);
    }
}
