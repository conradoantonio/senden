<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_type_id')->unsigned()->nullable();
            $table->integer('business_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('photo')->default('img/default.jpg');
            $table->string('street')->nullable();
            $table->integer('ext_number')->unsigned()->nullable();
            $table->integer('int_number')->unsigned()->nullable();
            $table->string('colony')->nullable();//Colonia
            $table->string('municipality')->nullable();//Municipio
            $table->string('state')->nullable();
            $table->string('postal_code', 5)->nullable(); 
            $table->boolean('isPanelUser')->default(0); 
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
