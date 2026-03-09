<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('cover')->nullable();
            $table->timestamps();
        });

        Schema::create('galerie_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('galery_id')->nullable();
            $table->string('title')->nullable();
            $table->string('image');
            $table->integer('order')->default(1);;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galeries');
        Schema::dropIfExists('galerie_items');
    }
}
