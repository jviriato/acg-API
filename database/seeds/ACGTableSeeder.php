<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Aluno;
use App\Models\CategoriaAcg;
use App\Models\Acg;

class ACGTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $faker = Faker::create('pt_BR');
        $alunos = Aluno::all()->pluck('id')->toArray();
        $categorias_acg = CategoriaAcg::all()->pluck('id')->toArray();
        $status_tipos = ["Aprovada", "Reprovada", "Pendente"];
        for ($i = 0; $i < 120; $i++) {
            $id_aluno = $faker->randomElement($alunos);
            $id_categoria = $faker->randomElement($categorias_acg);
            $status = $faker->randomElement($status_tipos);
            $horas_requisitadas = random_int(1 , 120);
            $horas_efetivadas = random_int(1, $horas_requisitadas);
            $local_atividade = $faker->city;
            $data_inicial = $faker->dateTimeBetween($startDate = '-4 years',
                                                    $endDate = 'now',
                                                    $timezone = null);
            $data_final = $faker->dateTimeBetween($startDate = $data_inicial, 
                                                  $endDate = 'now',
                                                  $timezone = null);
            Acg::insert([
                'id_aluno' => $id_aluno,
                'id_categoria' => $id_categoria,
                'horas_requisitadas' => $horas_requisitadas,
                'horas_efetivadas' => $horas_efetivadas,
                'local_atividade' => $local_atividade,
                'data_inicial' => $data_inicial,
                'data_final' => $data_final,
                'status' => $status,
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }
    }
}
