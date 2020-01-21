<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBookDatesTable extends Migration
{
    public function up()
    {
        Schema::table('book_dates', function (Blueprint $table) {
            $table->unsignedInteger('students_email_id')->nullable();

            $table->foreign('students_email_id', 'students_email_fk_882493')->references('id')->on('students');

            $table->unsignedInteger('date_id');

            $table->foreign('date_id', 'date_fk_883133')->references('id')->on('available_dates');
        });
    }
}
