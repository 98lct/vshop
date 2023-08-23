<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('orderdetail')) {

            Schema::create('orderdetail', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('order_id');
                $table->foreign('order_id')
                ->references('id')->on('order')
                ->onDelete('cascade');

                $table->unsignedInteger('product_id');
                $table->foreign('product_id')
                ->references('id')->on('product')
                ->onDelete('cascade');

                $table->Integer('quantity');
                $table->unsignedInteger('discount_id')->nullable();
            // $table->foreign('discount_id')
            //     ->references('id')->on('discount')
                $table->double('price');
                $table->double('amount');
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
