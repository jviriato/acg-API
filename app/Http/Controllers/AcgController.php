<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Models\AcgAnexo;
use App\Models\Aluno;
use App\Models\Acg;

class AcgController extends Controller
{
    public function index()
    {
        try {
            $data = Acg::with('categoria')
                ->with('aluno')
                ->with('anexo')
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
            ->with('anexo')
            ->where('id_aluno', $idAluno)
            ->get();

        foreach ($data as $key => $item) {
            if (sizeof($item->anexo)) {
                foreach($item->anexo as $anexo_key => $anexo) {
                    $data[$key]->anexo[$anexo_key]->local_do_anexo = $this->urlArquivo($anexo->local_do_anexo);
                }
            }
        }
        
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

    public function acgUnica($id)
    {
        $data = Acg::with('categoria')
            ->with('aluno')
            ->with('anexo')
            ->where('id', $id)
            ->first();

        if (is_null($data)) {
            return response()->json('Nenhuma acg com este id encontrado.', 200);
        }

        foreach ($data->anexo as $anexo_key => $anexo) {
            $data->anexo[$anexo_key]->local_do_anexo = $this->urlArquivo($anexo->local_do_anexo);
        }

        return response()->json($data, 200);
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

    private function salvarAnexos($anexos, $id)
    {
        foreach ($anexos as $arquivo) {
            $path = $arquivo->store('public');
    
            $fileReady = [
                'id_acg' => $id,
                'local_do_anexo' => $path,
            ];
    
            AcgAnexo::create($fileReady);
        }
    }

    public function store(Request $request)
    {
        try {
            $resposta = Acg::create($request->except(['id', 'files']));
    
            $idAcg = $resposta->id;
            $files = $request->file('files', null);

            if(!is_null($files)) {
                $this->salvarAnexos($files, $idAcg);
            }

            return response()->json($resposta, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao obter acgs.'], 500);
        }
    }

    public function alterarStatus(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');

        $success = Acg::where('id', $id)
            ->update(['status' => $status]);

        return response()->json(['sucesso' => !!$success], 200);
    }

    private function urlArquivo($caminho)
    {
        $path = (explode('/', $caminho, 2))[1];

        $path = URL::to('/') . '/storage/' . $path;

        return $path;
    }
}
