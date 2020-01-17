<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcelReportsTable extends Migration
{
    public function up()
    {
        Schema::create('excel_reports', function (Blueprint $table) {
            $table->increments('id');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
