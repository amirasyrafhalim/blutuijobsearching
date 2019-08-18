<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating', function (Blueprint $table) {
            $table->bigIncrements('rate_id');
            $table->unsignedBigInteger('job_id')->index();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->unsignedBigInteger('seller_id')->index();
            $table->foreign('seller_id')->references('user_id')->on('jobs')->onDelete('cascade');
            $table->unsignedBigInteger('buyer_id')->index();
            $table->foreign('buyer_id')->references('user_id')->on('job_user')->onDelete('cascade');
            $table->integer('seller_rate')->nullable();
            $table->integer('buyer_rate')->nullable();
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
        Schema::dropIfExists('rating');
    }
}
