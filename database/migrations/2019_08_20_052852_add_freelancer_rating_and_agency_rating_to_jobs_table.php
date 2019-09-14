<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFreelancerRatingAndAgencyRatingToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->tinyInteger('freelancer_rating')->after('hired_user_id')->nullable();
            $table->tinyInteger('agency_rating')->after('freelancer_rating')->nullable();
            $table->text('freelancer_comment')->after('agency_rating')->nullable();
            $table->text('agency_comment')->after('freelancer_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->removeColumn('freelancer_rating');
            $table->removeColumn('agency_rating');
            $table->removeColumn('freelancer_comment');
            $table->removeColumn('agency_comment');
        });
    }
}
