<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Aluno;

class AlunoTableSeeder extends Seeder
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
        foreach (range(1,10) as $index) {
	        Aluno::insert([
                'nome' => $faker->name,
                'ativo' => $faker->numberBetween(0, 1),
                'matricula' => $faker->numberBetween(200000000, 201999999),
                'id_curso' => 1,
                'email' => $faker->email,
                'created_at' => $now,
                'updated_at' => $now
	        ]);
	    } 
    }
}
