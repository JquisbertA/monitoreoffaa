<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localidades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prov_id');
            $table->string('nombre',50);
            $table->string('observacion',300);
            $table->integer('estado')->default(1);
            $table->string('sysuser',30)->default('SYSTEM');
            $table->timestamps();

            $table->foreign('prov_id')->references('id')->on('provincias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('localidades');
    }
}
