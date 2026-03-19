<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string('title', 111);
            $table->bigInteger('type')->unsigned()->nullable();
            $table->string('slug', 111)->unique();
            $table->string('level', 21)->default('BAC +3');
            $table->text('body')->nullable();
            $table->string('duration')->default('3 ans');
            $table->string('schedule',70)->nullable();
            $table->integer('seats')->nullable();
            $table->string('img_read');
            $table->string('thumbnail');
            $table->string('img_view');
            $table->string('price')->nullable();
            $table->boolean('top')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('type')->references('id')->on('menus')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formations');
    }
}
