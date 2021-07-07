<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbljss2positionThirdTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbljss2position_third_terms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('admission_no')->nullable();
            $table->string('block')->nullable();
            $table->string('session')->nullable();
            $table->unsignedInteger('grandtotal')->nullable();
            $table->string('position')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbljss2position_third_terms');
    }
}
