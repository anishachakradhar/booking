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

            $table->string('consultancy_name')->nullable();

            $table->string('status');

            $table->integer('passport_number');

            $table->string('module');

            $table->string('conductor');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
