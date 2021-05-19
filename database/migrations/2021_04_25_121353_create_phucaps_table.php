<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhucapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phucaps', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('chucvu_id')->unsigned();
            $table->bigInteger('phongban_id')->unsigned();
            $table->foreign('chucvu_id')->references('id')->on('chucvus')->onDelete('cascade');
            $table->foreign('phongban_id')->references('id')->on('phongbans')->onDelete('cascade');
            $table->integer('salary');
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
        Schema::dropIfExists('phucaps');
    }
}
