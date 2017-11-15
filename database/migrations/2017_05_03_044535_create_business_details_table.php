<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id')->unsigned()->nullable();
            //domicilio fiscal
            $table->string('street')->nullable();
            $table->integer('ext_number')->unsigned()->nullable();
            $table->integer('int_number')->unsigned()->nullable();
            $table->string('postal_code', 5)->nullable();
            $table->string('colony')->nullable();//Colonia
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('phone', 20)->nullable();
            //fin domicilio fiscal
            $table->string('interbank_clabe', 18)->nullable();
            $table->string('bank_name')->nullable();
            $table->string('contract')->nullable();//Ruta del archivo pdf
            $table->string('contract_number')->nullable();
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
        Schema::dropIfExists('business_details');
    }
}
