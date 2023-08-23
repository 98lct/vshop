<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('order')) {

            Schema::create('order', function (Blueprint $table) {
                $table->increments('id');
                $table->string('code');
                $table->unsignedInteger('user_id');
                $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
                $table->Integer('phone');
                $table->string('email');
                $table->string('fullname');
                $table->string('method');
                $table->string('address');
                $table->Text('note');
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
