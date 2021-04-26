<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->integer('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->longText('description')->nullable();
            $table->longText('address')->nullable();
            $table->boolean('isAdmin')->default(0);
            $table->bigInteger('chucvu_id')->unsigned()->nullable();
            $table->bigInteger('phongban_id')->unsigned()->nullable();
            $table->foreign('chucvu_id')->references('id')->on('chucvus')->onDelete('cascade');
            $table->foreign('phongban_id')->references('id')->on('phongbans')->onDelete('cascade');
            $table->date('start_contract');
            $table->date('end_contract')->nullable();
            $table->longText('avatar')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
