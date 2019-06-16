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
            $table->foreign('userPackageId')->references('id')->on('userPackages');
            $table->bigInteger('mergedTo')->unsigned();
            $table->foreign('mergedTo')->references('id')->on('userPackages');
            $table->string('proofOfPayment')->nullable();
            $table->dateTime('startDate');
            $table->boolean('confirmed');
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
