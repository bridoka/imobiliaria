<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImoveisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imoveis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',20)->unique()->nullable(false);
            $table->string('titulo')->nullable(false);
            $table->integer('tipoimovel_id')->unsigned();
            $table->foreign('tipoimovel_id')->references('id')->on('tipoimovel');
            $table->string('logradouro',100)->nullable(true);
            $table->string('cep',8)->nullable(true);
            $table->string('cidade',100)->nullable(true);
            $table->string('estado',2)->nullable(true);
            $table->string('bairro',100)->nullable(true);
            $table->integer('numero')->nullable(true);
            $table->string('complemento',100)->nullable(true);
            $table->float('valor', 10, 2)->nullable(true);
            $table->string('tipocontrato',1)->nullable(true);
            $table->integer('areaimovel')->nullable(true);
            $table->integer('numquartos')->nullable(true);
            $table->integer('numsuites')->nullable(true);
            $table->integer('numsalas')->nullable(true);
            $table->integer('numgaragem')->nullable(true);
            $table->integer('numbanheiros')->nullable(true);
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
        Schema::dropIfExists('imoveis');
    }
}
