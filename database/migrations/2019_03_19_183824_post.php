<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Post extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('post')) {

            Schema::create('post', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->unsignedInteger('topic_id');
                $table->foreign('topic_id')
                ->references('id')->on('topic')
                ->onDelete('cascade');
                $table->string('type')->default('post');
                $table->string('slug');
                $table->text('describe');
                $table->Longtext('detail');
                $table->string('img')->nullable();
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
