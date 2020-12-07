<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgencyJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agency_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('agency_id');
            $table->string('property_manager_name',255)->nullable();
            $table->string('landlord',255)->nullable();
            $table->string('address_line_1',255)->nullable();
            $table->string('address_line_2',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('state',255)->nullable();
            $table->string('zipcode',255)->nullable();
            $table->string('country',255)->nullable();
            $table->string('loc',255)->nullable();
            $table->string('service_month',255)->nullable();
            $table->string('tenant',255)->nullable();
            $table->string('contact_details',255)->nullable();
            $table->string('completed',255)->nullable();
            $table->string('t_custom_field_1',255)->nullable();
            $table->string('loc_custom_field_1',255)->nullable();
            $table->string('exp_custom_field_1',255)->nullable();
            $table->string('t_custom_field_2',255)->nullable();
            $table->string('loc_custom_field_2',255)->nullable();
            $table->string('exp_custom_field_2',255)->nullable();
            $table->string('t_custom_field_3',255)->nullable();
            $table->string('loc_custom_field_3',255)->nullable();
            $table->string('exp_custom_field_3',255)->nullable();
            $table->string('t_custom_field_4',255)->nullable();
            $table->string('loc_custom_field_4',255)->nullable();
            $table->string('exp_custom_field_4',255)->nullable();
            $table->string('comments',255)->nullable();
            $table->string('amount',255)->nullable();
            $table->string('referral',255)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index('deleted_at');

            $table->foreign('agency_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agency_jobs');
    }
}
