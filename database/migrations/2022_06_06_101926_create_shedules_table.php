<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('days_id');
            $table->foreignId('times_id');
            $table->string('description', 255)->nullable(false);
            $table->string('name', 255)->nullable(false);

            $table->timestamps();

            $table->foreign('days_id')
                ->references('id')
                ->on('days')
                ->onDelete('cascade');
            $table->foreign('times_id')
                ->references('id')
                ->on('times')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shedules');
    }
}
