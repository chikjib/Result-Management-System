<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbljss2studentFirstTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbljss2student_first_terms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('passport')->nullable();
            $table->string('admission_no')->nullable();
            $table->string('surname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('othername')->nullable();
            $table->string('sex')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('name_of_parents')->nullable();
            $table->string('address')->nullable();
            $table->string('state');
            $table->string('phone_no')->nullable();
            $table->string('class')->nullable();
            $table->string('block')->nullable();
            $table->string('session')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbljss2student_first_terms');
    }
}
