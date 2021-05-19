<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumNumberToPhucapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phucaps', function (Blueprint $table) {
            $table->date('time_start')->nullable();
            $table->date('time_end')->nullable();
            $table->boolean('precent_salary')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phucaps', function (Blueprint $table) {
            //
        });
    }
}
