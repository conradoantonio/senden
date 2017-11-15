<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id')->unsigned()->nullable();
            $table->integer('order_id')->unsigned()->nullable();
            $table->dateTime('start_order');
            $table->dateTime('complete_order');
            $table->string('street')->nullable();
            $table->integer('ext_number')->unsigned()->nullable();
            $table->integer('int_number')->unsigned()->nullable();
            $table->string('postal_code', 5)->nullable();
            $table->string('colony')->nullable();//Colonia
            $table->string('city')->nullable();
            $table->string('state')->nullable();
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
        Schema::dropIfExists('orders_history');
    }
}
