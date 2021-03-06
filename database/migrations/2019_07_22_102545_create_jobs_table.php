<?php

use App\Job;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->index(); // The one who created the job.
            $table->unsignedInteger('category')->default(Job::CATEGORY_DEFAULT);
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('price')->nullable();
            $table->tinyInteger('status')->default(Job::STATUS_DRAFT);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
