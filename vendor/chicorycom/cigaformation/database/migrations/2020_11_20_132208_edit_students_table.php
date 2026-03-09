<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table){
            $table->date('birthday')->change()->nullable();
            $table->string('place_birth',121)->change()->nullable();
            $table->string('nationality',70)->change()->nullable();
            $table->string('address')->change()->nullable();
            $table->string('city', 70)->change()->nullable();
            $table->string('country', 70)->change()->nullable();
            $table->string('email')->change()->nullable();
            $table->string('phone')->change()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table){
            $table->date('birthday')->change();
            $table->string('place_birth',121)->change();
            $table->string('nationality',70)->change();
            $table->string('address')->change();
            $table->string('city', 70)->change();
            $table->string('country', 70)->change();
            $table->string('email')->change();
            $table->string('phone')->change();
        });
    }
}
