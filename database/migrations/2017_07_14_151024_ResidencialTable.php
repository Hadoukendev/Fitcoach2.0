<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ResidencialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('residenciales', function (Blueprint $table) {
          $table->increments('id');
          $table->date('fecha');
          $table->string('hora');
          $table->integer('user_id');
          $table->integer('condominio_id');
          $table->integer('clase_id');
          $table->string('precio');
          $table->string('audiencia');
          $table->string('cupo');
          $table->string('ocupados');
          $table->string('tipo');
          $table->string('descripcion');
          $table->string('nombreevento');
          $table->string('direccionevento');
          $table->string('imagenevento');
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
        Schema::drop('residenciales');
    }
}
