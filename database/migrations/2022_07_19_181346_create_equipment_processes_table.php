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
        Schema::create('equipment_processes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('block_id');
            $table->foreignId('equipment_id');
            $table->string('equipment_type');
            $table->float('gas_usage')->nullable();
            $table->string('period')->nullable();
            $table->float('kWh')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment_processes');
    }
};
