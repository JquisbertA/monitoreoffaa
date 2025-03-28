<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeqUnidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peq_unidads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_gran_unidad');
            $table->unsignedBigInteger('id_fuerza');
            $table->string('peq_unidad',150);
            $table->string('abreviatura',50);
            $table->string('descripcion',300);
            $table->decimal('lat', 10, 8);
            $table->decimal('lng', 11, 8);
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
        Schema::dropIfExists('peq_unidads');
    }
}
