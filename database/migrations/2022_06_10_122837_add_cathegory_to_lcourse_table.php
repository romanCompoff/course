<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCathegoryToLcourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('l_courses', function (Blueprint $table) {
            // $table->foreignId('cathegory_id');
            $table->foreign('cathegory_id')
            ->references('id')
            ->on('cathegoryes');
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
        Schema::table('l_courses', function (Blueprint $table) {
            //
        });
    }
}
