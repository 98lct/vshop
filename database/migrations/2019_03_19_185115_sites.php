<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('sites')) {

            Schema::create('sites', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->string('metakey');
                $table->string('metadesc');
                $table->string('email');
                $table->string('address');
                $table->integer('phone');
                $table->string('logo');
                $table->string('icon');
                $table->text('facebook');
                $table->text('maps');
                $table->text('messager');
                $table->text('gmail');
                $table->text('youtube');
                $table->text('copyright');
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
