<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMergesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('userPackageId')->unsigned();
            $table->foreign('userPackageId')->references('id')->on('user_packages');
            $table->bigInteger('mergedTo')->unsigned();
            $table->foreign('mergedTo')->references('id')->on('user_packages');
            $table->string('proofOfPayment')->nullable();
            $table->dateTime('startDate');
            $table->boolean('confirmed')->default(false);
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
        Schema::dropIfExists('merges');
    }
}
