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

            $table->string('status')->deafult('На обслуживании');

            $table->unsignedInteger('mileage');
            $table->year('manufacture_year');
            $table->string('location');
            $table->string('license_plate')->unique();
            $table->unsignedInteger('price_at_hour');

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
