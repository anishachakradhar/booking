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

            $table->date('available_date')->unique();

            $table->integer('available_seat')->default(50);

            $table->string('available_date_id')->unique();

            $table->string('available_date_status')->default('active');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
