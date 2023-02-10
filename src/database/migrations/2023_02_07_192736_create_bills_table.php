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

            $table->integer('renters_count')->default(1);
            $table->unsignedBigInteger('balance');
            $table->string('status')->default('open');
            $table->string('type')->default('pesonal');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('bill_renter', function (Blueprint $table) {
            $table->id();

            $table->foreignID('bill_id')->constrained()->onDelete('cascade');
            $table->foreignID('renter_id')->constrained()->onDelete('cascade');

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
        Schema::dropIfExists('bill_renter');
        Schema::dropIfExists('bills');
    }
};
