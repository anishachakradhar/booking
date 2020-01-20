<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookDatesTable extends Migration
{
    public function up()
    {
        Schema::create('book_dates', function (Blueprint $table) {
            $table->increments('id');

            $table->string('book_date_id')->unique();

            $table->string('available_date_id');

            $table->foreign('available_date_id')->references('available_date_id')->on('available_dates');

            $table->string('student_id');

            $table->foreign('student_id')->references('student_id')->on('students');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
