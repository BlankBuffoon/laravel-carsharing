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
        Schema::create('renters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_account_id')->constrained();

            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');

            $table->string('status')->default('Активен');
            $table->unsignedBigInteger('phone_number');
            $table->string('email');
            $table->string('passport');

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
        Schema::dropIfExists('renters');
    }
};
