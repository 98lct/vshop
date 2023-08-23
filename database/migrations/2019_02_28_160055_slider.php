<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Slider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('slider')) {
            Schema::create('slider', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('url');
                $table->string('img');
                $table->string('possition')->default('full-width');
                $table->tinyInteger('status')->default('1');
                $table->timestamps();
            });
        };
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
