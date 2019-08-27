<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acg', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->unsignedInteger('id_aluno');
            $table->unsignedInteger('id_categoria');
            $table->integer('horas_requisitadas');
            $table->integer('horas_efetivadas');
            $table->string('local_atividade');
            $table->date('data_inicial');
            $table->date('data_final');
            $table->string('status');

            $table->foreign('id_aluno', 'fk_id_aluno')
                ->references('id')->on('aluno')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('id_categoria', 'fk_id_categoria')
                ->references('id')->on('categoria_acg')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acg');
    }
}
