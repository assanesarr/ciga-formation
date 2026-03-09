<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->unsigned()->nullable()->default(null);
            $table->foreign('parent_id')->references('id')->on('programmes')->onUpdate('cascade')->onDelete('set null');
            $table->string('name');
        });

        \Chicorycom\Cigaformation\Models\Menu::create([
            'name' => 'Programmes',
            'type' => 'ADMIN',
            'parent_id' => 2,
            'slug' => 'programmes',
            'icon' => 'fas fa-tasks',
            'order' => 7,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programmes');
        \Chicorycom\Cigaformation\Models\Menu::where('type', 'ADMIN')->where('slug', 'programmes')->delete();
    }
}
