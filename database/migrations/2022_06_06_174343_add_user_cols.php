<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserCols extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usersbig', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('groupe-id');
            $table->foreignId('user-id');
            $table->string('last_name', 255)->nullable();
            $table->string('first_name', 255)->nullable();
            $table->string('moddle_name', 255)->nullable();
            $table->string('phn_number', 255)->nullable();
            $table->foreign('groupe-id')
                ->references('id')
                ->on('groups');
            $table->foreign('user-id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('usersbig');

    }
}
