<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendenDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senden_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contact_number')->nullable();
            $table->text('address');
            $table->string('contact_email')->nullable();
            $table->string('privacity_terms_file')->nullable();//path to file
            $table->string('terms_and_conditions_file')->nullable();//path to file
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('logo')->nullable();//path to logo
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
        Schema::dropIfExists('senden_data');
    }
}
