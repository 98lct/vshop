<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class City extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     if(!Schema::hasTable('city')) {
        Schema::create('city', function (Blueprint $table) {
         $table->increments('id');
         $table->double('cost')->default('0');
         $table->string('name');
         $table->timestamps();
     });
    }
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
