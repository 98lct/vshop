<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('product')) {
            Schema::create('product', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->unsignedInteger('category_id');
                $table->foreign('category_id')
                    ->references('id')->on('category')
                    ->onDelete('cascade');
                $table->unsignedInteger('brand_id');
                $table->foreign('brand_id')
                    ->references('id')->on('brand')
                    ->onDelete('cascade');
                $table->string('slug');
                $table->string('img');
                $table->Longtext('detail');
                $table->Text('describe');
                $table->string('screen')->nullable();
                $table->Integer('ram')->nullable();
                $table->Integer('rom')->nullable();
                $table->Integer('rom_available')->nullable();
                $table->Integer('battery')->nullable();
                $table->Integer('camera_primary')->nullable();
                $table->Integer('camera')->nullable();
                $table->text('camera_info')->nullable();
                $table->text('connect')->nullable();
                $table->text('resolution')->nullable();
                $table->text('utilities')->nullable();
                $table->text('other_information')->nullable();
                $table->string('operating')->nullable();
                $table->string('chipset')->nullable();
                $table->string('gpu')->nullable();
                $table->string('design')->nullable();
                $table->string('material')->nullable();
                $table->string('size')->nullable();
                $table->Integer('weight')->nullable();
                $table->Integer('number');
                $table->Integer('price');
                $table->Integer('pricesale');
                $table->Integer('views')->default('1');
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
