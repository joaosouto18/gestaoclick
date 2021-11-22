<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->decimal('preco', 5, 2);	
            $table->integer('estoque');	
            $table->string('sku');
            $table->string('link_produto');
            $table->string('foto');
            $table->longText('descricao');	
            $table->string('lote');
            $table->decimal('precoPromo', 5, 2);	
            $table->string('validade');
            $table->tinyInteger('produtoDisponivel');	
            $table->tinyInteger('produtoVitrine');	
            $table->tinyInteger('produtoLancamento');	
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
        Schema::dropIfExists('products');
    }
}
