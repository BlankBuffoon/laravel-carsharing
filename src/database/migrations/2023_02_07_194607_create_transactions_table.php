<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('bill_id');
            $table->foreignId('renter_id');

            $table->integer('modification')->comment("Модификация операции со счетом (например. +100 или -100)");
            $table->dateTime('transaction_datetime')->comment("Время и дата операции");
            $table->string('reason')->nullable()->comment('Причина изменения счета');

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
        Schema::dropIfExists('transactions');
    }
};
