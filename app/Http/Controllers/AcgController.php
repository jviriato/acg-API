<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acg;
use App\Models\Aluno;

class AcgController extends Controller
{
    public function index()
    {
        try {
            $data = Acg::with('categoria')
                ->with('aluno')
                ->get();
    
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao obter acgs.'], 500);
        }
    }

    private function acgPorMatricula($matricula)
    {
        $idAluno = Aluno::select('id')
            ->where('matricula', $matricula)
            ->first();

        if ($idAluno == null) {
            return [];
        }

        $idAluno = $idAluno->id;

        $data = Acg::with('categoria')
            ->with('aluno')
            ->where('id_aluno', $idAluno)
            ->get();

        return $data;

    }

    public function porAluno($matricula)
    {
        try {
            $acgs = $this->acgPorMatricula($matricula);

            return response()->json($acgs, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao obter acgs.'], 500);
        }
    }

    public function totalHorasAluno($matricula)
    {
        try {
            $acgs = $this->acgPorMatricula($matricula);

            $horasEfetivadasCategoria = [];
            $total = 0;

            foreach ($acgs as $acg) {
                if (array_key_exists($acg->categoria->tipo, $horasEfetivadasCategoria)) {
                    $horasEfetivadasCategoria[$acg->categoria->tipo]['efetivadas'] += $acg->horas_efetivadas;
                    $horasEfetivadasCategoria[$acg->categoria->tipo]['requisitadas'] += $acg->horas_requisitadas;
                } else {
                    $horasEfetivadasCategoria[$acg->categoria->tipo]['efetivadas'] = $acg->horas_efetivadas;
                    $horasEfetivadasCategoria[$acg->categoria->tipo]['requisitadas'] = $acg->horas_requisitadas;
                }
                $total += $acg->horas_efetivadas;
            }
            
            return response()->json(['por_categoria' => $horasEfetivadasCategoria, 'total_aprovado' => $total], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao calcular as horas de acgs.'], 500);
        }
    }

    public function store(Request $request)
    {
        $resposta = Acg::create($request->except('id'));

        return response()->json($resposta, 200);
    }

    public function alterarStatus(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');

        $success = Acg::where('id', $id)
            ->update(['status' => $status]);

        return response()->json(['sucesso' => !!$success], 200);
    }
}
