<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 121);
            $table->string('last_name',121);
            $table->date('birthday');
            $table->string('place_birth',121);
            $table->string('nationality',70);
            $table->enum('genre', ['Masculin','Féminin'])->default('Masculin');
            $table->string('address');
            $table->string('city', 70);
            $table->string('country', 70);
            $table->string('email');
            $table->string('phone');
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('avatar')->default('/assets/svg/account.svg');
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
        Schema::dropIfExists('students');
    }
}
