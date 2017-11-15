<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('tradename')->nullable();
            $table->string('name')->nullable();//Razón social
            $table->string('rfc', 13)->nullable();
            //domicilio físico
            $table->string('street')->nullable();
            $table->integer('ext_number')->unsigned()->nullable();
            $table->integer('int_number')->unsigned()->nullable();
            $table->string('postal_code', 5)->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->string('colony')->nullable();//Colonia
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('phone', 20)->nullable();
            //fin domicilio físico
            $table->string('logo')->nullable();
            $table->string('photo1')->nullable();
            $table->string('photo2')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses');
    }
}
