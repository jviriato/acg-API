<?php

use Illuminate\Database\Seeder;
use App\Models\CategoriaAcg;

class CategoriaACGTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $categorias = [
            ['Participação em eventos', 75],
            ['Atuação em núcleo temático', 75],
            ['Atividades de extensão', 75],
            ['Estágios extra-curriculares', 150],
            ['Atividades de iniciação científica', 150],
            ['Publicação de trabalhos', 75],
            ['Participação em órgãos colegiados e diretórios acadêmicos', 75],
            ['Monitoria', 135],
            ['Outras atividades', 75]
        ];

        foreach($categorias as $categoria)
        {
            CategoriaAcg::insert([
                'id_curso' => 1,
                'tipo' => $categoria[0],
                'qtd_horas_maximas' => $categoria[1],
                'created_at' => $now,
                'updated_at' => $now
            ]);   
        }
    }
}
