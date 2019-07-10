<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('username',190)->unique();
            $table->string('password');
            $table->string('phone');
            $table->string('role')->default('user');
            $table->string('image')->nullable();
            $table->string('bankName');
            $table->string('accountName');
            $table->string('accountNumber');
            $table->integer('potential')->default(0);
            $table->string('ref');
            $table->string('referredBy')->nullable();
            $table->boolean('blocked')->default(false);
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
