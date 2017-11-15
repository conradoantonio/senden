<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('sendenboy_id')->unsigned()->nullable();
            $table->integer('business_id')->unsigned()->nullable();
            $table->integer('status_id')->unsigned()->nullable();
            $table->integer('order_number')->unsigned();
            $table->string('street')->nullable();
            $table->integer('ext_number')->unsigned()->nullable();
            $table->integer('int_number')->unsigned()->nullable();
            $table->string('postal_code', 5)->nullable();
            $table->string('colony')->nullable();//Colonia
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->decimal('flag', 5, 4)->nullable();//*($20) este es el cobro de conekta
            $table->decimal('comission', 4, 2)->nullable();//*($2.90)
            $table->decimal('shipping_price', 4, 4)->nullable();
            $table->decimal('total', 5, 4)->nullable();
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
        Schema::dropIfExists('order');
    }
}
