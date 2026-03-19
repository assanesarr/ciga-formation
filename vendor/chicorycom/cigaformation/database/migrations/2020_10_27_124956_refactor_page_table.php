<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pages');
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['GRID', 'LIST', 'DETAIL']);
            $table->string('title');
            $table->text('excerpt')->nullable();
            $table->string('background')->default('/images/banner.jpg');
            $table->string('thumbnail')->default('/images/banner_thumbnail.jpg');
        });
        Schema::create('menu_page', function (Blueprint $table) {
            $table->bigInteger('menu_id')->unsigned()->index();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->bigInteger('page_id')->unsigned()->index();
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_page');
        Schema::dropIfExists('pages');
    }
}
