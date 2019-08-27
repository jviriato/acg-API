<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaAcgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_acg', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->unsignedInteger('id_curso');
            $table->string('tipo');
            $table->integer('qtd_horas_maximas');

            $table->foreign('id_curso', 'fk_id_curso')
                ->references('id')->on('curso')
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
        Schema::dropIfExists('categoria_acg');
    }
}
