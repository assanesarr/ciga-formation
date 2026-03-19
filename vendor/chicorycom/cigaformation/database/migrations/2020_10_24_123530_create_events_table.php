<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['EVENT', 'INFO', 'DIRECTOR'])->default('EVENT');
            $table->string('title');
            $table->string('slug');
            $table->text('body');
            $table->string('location', 111)->default('Dakar');
            $table->boolean('status')->default(true);
            $table->date('inDate')->nullable();
            $table->string('start', 21)->nullable();
            $table->string('end', 21)->nullable();
            $table->string('img')->nullable();
            $table->string('img_view')->nullable();
            $table->string('thumbnail')->nullable();
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
        Schema::dropIfExists('events');
    }
}
