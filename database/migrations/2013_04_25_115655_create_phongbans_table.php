<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhongbansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phongbans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('icon');
            $table->bigInteger('chucvu_id')->unsigned();
            $table->foreign('chucvu_id')->references('id')->on('chucvus')->onDelete('cascade');
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
        Schema::dropIfExists('phongbans');
    }
}
