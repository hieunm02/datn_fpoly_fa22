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
            $table->id();
            $table->string('name',255);
            $table->unsignedBigInteger('menu_id')->unsigned();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');

            $table->unsignedBigInteger('price_id')->unsigned();
            $table->foreign('price_id')->references('id')->on('prices')->onDelete('cascade');

            $table->text('thumb');
            $table->text('content');
            $table->integer('active');
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
