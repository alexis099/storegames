<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJuegosTable extends Migration
{
    protected $tabla = 'juego';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tabla, function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 80);
            $table->mediumText('descripcion');
            $table->decimal('precio', $precision = 6, $scale = 2);
            $table->timestamp('fecha_publicacion');
            $table->bigInteger('distribuidora')->unsigned();
            $table->bigInteger('desarrolladora')->unsigned();
            $table->string('portada');


            $table->foreign('distribuidora')->references('id')->on('empresa');
            $table->foreign('desarrolladora')->references('id')->on('empresa');
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
        Schema::dropIfExists($this->tabla);
    }
}
