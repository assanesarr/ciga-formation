<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreregistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preregisters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->enum('ciga_frequency', ['OUI', 'NON'])->default('NON');
            $table->string('lastYaer', 4)->nullable();
            $table->string('school_name')->nullable();
            $table->string('school_address')->nullable();
            $table->string('which_institute', 4)->nullable();
            $table->string('code')->nullable();
            $table->date('entry_date')->nullable();
            $table->date('release_date')->nullable();
            $table->string('level_reached')->nullable();
            $table->string('level_reached_file')->nullable();
            $table->enum('campus', ['Guediawaye', 'Malika'])->default('Guediawaye');
            $table->date('promotion_date')->nullable();
            $table->string('programme');
            $table->enum('completed', ['COMPLETED', 'INCOMPLETED'])->default('INCOMPLETED');
            $table->dateTime('read_at')->nullable();
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
        Schema::dropIfExists('preregisters');
    }
}
