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

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
