<?php

use App\Enums\Renter\RenterStatus;
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

            $table->foreignId('default_bill')
                ->nullable()
                ->references('id')
                ->on('bills')
                ->comment("Выбранный пользователем счет по умолчанию");

            $table->string('first_name')->comment("Имя пользователя");
            $table->string('middle_name')->comment("Фамилия пользователя");
            $table->string('last_name')->comment("Отчество пользователя");

            $table->enum('status', RenterStatus::getValues())->default(RenterStatus::Active)->comment("Статус пользователя");
            $table->unsignedBigInteger('phone_number')->unique()->comment("Номер телефона пользователя");
            $table->string('email')->unique()->comment("Электронная почта пользователя");
            $table->string('passport')->unique()->comment("Номер и серия паспорта пользователя");

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
