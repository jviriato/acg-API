<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAcgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acg', function (Blueprint $table) {
            $table->integer('horas_efetivadas')->nullable()->default(0)->change();
            $table->string('status')->nullable()->default('Pendente')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('acg', function (Blueprint $table) {
            $table->integer('horas_efetivadas')->change();
            $table->string('status')->change();
        });
    }        
}
