<?php

use App\Enums\Rent\RentStatus;
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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained();
            $table->foreignId('renter_id')->constrained();

            $table->enum('status', RentStatus::getValues())->default(RentStatus::Open)->comment("Статус аренды");
            $table->dateTime('begin_datetime')->comment("Дата и время начала аренды");
            $table->dateTime('end_datetime')->nullable()->comment("Дата и время конца аренды");
            $table->integer('rented_time')->nullable()->comment("Общее время аренды (в минутах)");
            $table->unsignedInteger('total_price')->nullable()->comment("Итоговая цена за аренду");

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
        Schema::dropIfExists('rents');
    }
};
