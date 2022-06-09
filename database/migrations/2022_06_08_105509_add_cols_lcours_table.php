<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsLcoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('l_courses', function (Blueprint $table) {
            $table->foreignId('shedule_id');
            $table->foreignId('teacher_id');
            $table->foreignId('lvl_id');
            $table->foreignId('group_id');
            $table->string('name');
            $table->string('description');
            $table->string('img');
            $table->foreign('shedule_id')
            ->references('id')
            ->on('shedules');
            $table->foreign('teacher_id')
            ->references('id')
            ->on('teachers');
            $table->foreign('lvl_id')
            ->references('id')
            ->on('lvl_lang');
            $table->foreign('group_id')
            ->references('id')
            ->on('groups');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('l_course', function (Blueprint $table) {
            //
        });
    }
}
