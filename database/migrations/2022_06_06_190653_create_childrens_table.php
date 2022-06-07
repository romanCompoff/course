<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childrens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('lst_name', 255)->nullable(false);
            $table->string('fst_name', 255)->nullable(false);
            $table->string('mdl_name', 255)->nullable(false);
            $table->date('bth_day');
            $table->timestamps();
            $table->foreign('user_id')
            ->references('id')
            ->on('usersbig');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('childrens');
    }
}
