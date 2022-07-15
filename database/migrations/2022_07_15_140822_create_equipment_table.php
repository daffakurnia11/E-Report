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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('block_id');
            $table->string('type');
            $table->foreignId('equipment_gas_id')->nullable();
            $table->foreignId('equipment_electric_id')->nullable();
            $table->string('flowmeter')->nullable();
            $table->string('volt')->nullable();
            $table->string('ampere')->nullable();
            $table->string('watt')->nullable();
            $table->string('activity');
            $table->string('status')->nullable();
            $table->timestamps();
            $table->timestamp('stopped_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment');
    }
};
