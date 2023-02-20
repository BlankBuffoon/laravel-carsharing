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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();

            $table->integer('renters_count')->default(1)->comment("Колличество пользователей связанных со счетом");
            $table->unsignedBigInteger('balance')->comment("Баланс счета (в копейках)");
            $table->string('status')->default('open')->comment("Статус счета");
            $table->string('type')->default('pesonal')->comment("Тип счета");

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
        Schema::dropIfExists('bills');
    }
};
