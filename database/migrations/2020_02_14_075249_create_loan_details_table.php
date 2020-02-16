<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('loan_id');
            $table->integer('month');
            $table->integer('year');
            $table->decimal('amount', 21, 6);
            $table->decimal('principal', 21, 6);
            $table->decimal('interest', 21, 6);
            $table->decimal('balance', 21, 6);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_details');
    }
}
