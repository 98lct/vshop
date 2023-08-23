<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Discount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('discount')) {
            Schema::create('discount', function (Blueprint $table) {
               $table->increments('id');
               $table->string('code');
               $table->date('expiration');
               $table->integer('limit');
               $table->float('discount');
               $table->tinyInteger('status')->default('1');
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
