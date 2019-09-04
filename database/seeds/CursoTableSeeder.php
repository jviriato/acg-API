<?php

use Illuminate\Database\Seeder;
use App\Models\Curso;

class CursoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Curso::insert([
            'nome' => 'Ciência da Computação',
            'qtd_horas_totais_acg' => 290
        ]);
    }
}
