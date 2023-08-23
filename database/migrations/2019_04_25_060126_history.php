<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class History extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('history')) {

            Schema::create('history', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->unsignedInteger('user_id');
                $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
                $table->dateTime('time');
                $table->enum('action', ['add', 'edit','delete','status','restore','trash']);
                $table->string('content');

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
