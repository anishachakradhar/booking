<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('email')->unique();

            $table->integer('phone');

            $table->date('dob');

            $table->string('address');

            $table->string('status')->default('pending');

            $table->integer('passport_number');

            $table->string('conductor_id');

            $table->foreign('conductor_id')->references('conductor_id')->on('conductors');

            $table->string('module_id');

            $table->foreign('module_id')->references('module_id')->on('modules');

            $table->string('location_id');

            $table->foreign('location_id')->references('location_id')->on('locations');

            $table->string('student_id')->unique();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
