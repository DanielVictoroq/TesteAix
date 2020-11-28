<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('situacao_aluno', function (Blueprint $table) {
            $table->id();
            $table->string('situacao', 500)->nullable();
            $table->timestamps();
        });

        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('cep', 500)->nullable();
            $table->string('rua', 500)->nullable();
            $table->integer('numero')->nullable();
            $table->string('complemento', 500)->nullable();
            $table->string('bairro', 500)->nullable();
            $table->string('cidade', 500)->nullable();
            $table->string('estado', 500)->nullable();
            $table->timestamps();
        });

        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('name', 500)->nullable();
            $table->string('cod_aluno', 100)->nullable();
            $table->date('dtmatricula')->nullable();
            $table->string('turma', 100)->nullable();
            $table->bigInteger('situacao_id')->unsigned()->nullable();
            $table->foreign('situacao_id')->references('id')->on('situacao_aluno');
            $table->bigInteger('endereco_id')->unsigned()->nullable();
            $table->foreign('endereco_id')->references('id')->on('endereco');
            $table->bigInteger('curso_id')->unsigned()->nullable();
            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->string('path_image', 100)->nullable();
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
        Schema::dropIfExists('alunos');
    }
}
