<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConductorsTable extends Migration
{
    public function up()
    {
        Schema::create('conductors', function (Blueprint $table) {
            $table->increments('id');

            $table->string('conductor')->nullable();

            $table->string('conductor_id')->unique();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
