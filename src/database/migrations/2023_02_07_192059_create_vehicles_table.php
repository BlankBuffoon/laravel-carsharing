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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vehicle_model_id')->constrained();

            $table->string('status')->deafult('maintenance')->comment("Статус ТС");

            $table->unsignedInteger('mileage')->comment("Пробег ТС");
            $table->year('manufacture_year')->comment("Год производства ТС");
            $table->string('location')->comment("Координаты текущего местоположения ТС");
            $table->string('license_plate')->unique()->comment("Гос. номер ТС");
            $table->unsignedInteger('price_at_minute')->comment("Цена за минуту аренды (в рублях)");

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
        Schema::dropIfExists('vehicles');
    }
};
