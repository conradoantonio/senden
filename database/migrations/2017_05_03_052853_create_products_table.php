<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('business_id')->unsigned()->nullable();
            $table->integer('status_id')->unsigned()->nullable();
            $table->integer('vehicle_id')->unsigned()->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->double('price')->nullable();
            $table->integer('stock')->unsigned();
            $table->enum('weight', ['00 a 05 kilos', '05 a 15 kilos', '15 a 40 kilos']);    
            $table->string('lenght')->nullable();
            $table->string('height')->nullable();
            $table->string('width')->nullable();               
            $table->boolean('is_best_seller')->nullable();
            $table->boolean('in_promotion')->nullable();
            $table->time('start_selling')->nullable();
            $table->time('end_selling')->nullable();
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
