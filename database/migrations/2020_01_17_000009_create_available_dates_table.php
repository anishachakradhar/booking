<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailableDatesTable extends Migration
{
    public function up()
    {
        Schema::create('available_dates', function (Blueprint $table) {
            $table->increments('id');

            $table->date('available_date')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
