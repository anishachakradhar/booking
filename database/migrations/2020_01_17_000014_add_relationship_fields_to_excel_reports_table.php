<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToExcelReportsTable extends Migration
{
    public function up()
    {
        Schema::table('excel_reports', function (Blueprint $table) {
            $table->unsignedInteger('name_id')->nullable();

            $table->foreign('name_id', 'name_fk_882485')->references('id')->on('students');

            $table->unsignedInteger('email_id')->nullable();

            $table->foreign('email_id', 'email_fk_882486')->references('id')->on('students');

            $table->unsignedInteger('phone_id')->nullable();

            $table->foreign('phone_id', 'phone_fk_882487')->references('id')->on('students');

            $table->unsignedInteger('dob_id')->nullable();

            $table->foreign('dob_id', 'dob_fk_882488')->references('id')->on('students');

            $table->unsignedInteger('address_id')->nullable();

            $table->foreign('address_id', 'address_fk_882525')->references('id')->on('students');

            $table->unsignedInteger('consultancy_name_id')->nullable();

            $table->foreign('consultancy_name_id', 'consultancy_name_fk_882526')->references('id')->on('students');

            $table->unsignedInteger('location_id')->nullable();

            $table->foreign('location_id', 'location_fk_883113')->references('id')->on('students');

            $table->unsignedInteger('conductor_id')->nullable();

            $table->foreign('conductor_id', 'conductor_fk_883114')->references('id')->on('students');

            $table->unsignedInteger('module_id')->nullable();

            $table->foreign('module_id', 'module_fk_883115')->references('id')->on('students');
        });
    }
}
