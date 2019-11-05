<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;

class UsuarioController extends Controller
{
    public function obterUsuario(Request $request)
    {
        $nome = $request->input('nome');
        $senha = $request->input('senha');

        $data = Usuarios::where('nome', $nome)->where('senha', $senha)->first();

        if(is_null($data)) {
            return response()->json('Credenciais inválidas', 401);
        }

        return response()->json($data, 200);
    }
}
