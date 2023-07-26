<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaServicios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_servicios', function (Blueprint $table) {
            $table->id();
            $table->string('sigla',100);
            $table->string('descripcion',500);
            $table->string('codigo');
            $table->integer('estado')->default(1);
            $table->string('sysuser',30)->default('SYSTEM');
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
        Schema::dropIfExists('empresa_servicios');
    }
}
