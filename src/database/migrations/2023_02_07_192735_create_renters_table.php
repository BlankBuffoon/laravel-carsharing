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

            $table->string('first_name')->comment("Имя пользователя");
            $table->string('middle_name')->comment("Фамилия пользователя");
            $table->string('last_name')->comment("Отчество пользователя");

            $table->string('status')->default('active')->comment("Статус пользователя");
            $table->unsignedBigInteger('phone_number')->comment("Номер телефона пользователя");
            $table->string('email')->comment("Электронная почта пользователя");
            $table->string('passport')->comment("Номер и серия паспорта пользователя");

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
