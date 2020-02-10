<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('book_date_id')->unique();
            $table->foreign('book_date_id')->references('book_date_id')->on('book_dates');
            $table->string('student_id')->unique();
            $table->foreign('student_id')->references('student_id')->on('students');
            $table->string('payment_id');
            $table->string('type_id');
            $table->string('type_name');
            $table->string('status_id');
            $table->string('status_name')->default('pending');
            $table->string('amount')->default(0);
            $table->string('fee_amount')->default(0);
            $table->string('refund_status');
            $table->string('user_id');
            $table->string('user_name');
            $table->string('user_phone');
            $table->string('merchant_id');
            $table->string('merchant_name');
            $table->string('merchant_phone');
            $table->string('token');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
