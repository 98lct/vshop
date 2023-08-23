<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Comment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('conment')) {
            Schema::create('conment', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('product_id');
                $table->foreign('product_id')
                ->references('id')->on('product')
                ->onDelete('cascade');
                $table->unsignedInteger('user_id');
                $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
                $table->Text('content');
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
