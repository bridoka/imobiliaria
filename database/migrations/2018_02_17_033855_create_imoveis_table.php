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
            $table->string('logradouro',100)->nullable(false);
            $table->string('cep',8)->nullable(false);
            $table->string('cidade',100)->nullable(false);
            $table->string('estado',2)->nullable(false);
            $table->string('bairro',100)->nullable(false);
            $table->integer('numero');
            $table->string('complemento',100);
            $table->float('valor', 10, 2);
            $table->string('tipocontrato',1);
            $table->integer('areaimovel');
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
