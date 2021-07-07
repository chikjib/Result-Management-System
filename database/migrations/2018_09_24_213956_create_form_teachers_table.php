<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('passport');
            $table->string('surname');
            $table->string('firstname');
            $table->string('sex');
            $table->string('address');
            $table->string('phone_no');
            $table->string('qualification');
            $table->string('state');
            $table->string('class');
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
        Schema::dropIfExists('form_teachers');
    }
}
