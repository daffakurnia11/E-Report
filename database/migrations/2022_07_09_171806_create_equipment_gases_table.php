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
        Schema::create('equipment_gases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('gas_filter');
            $table->integer('flowmeter');
            $table->integer('capacity')->nullable();
            $table->string('unit')->nullable();
            $table->integer('quantity')->default(1);
            $table->string('activity')->nullable();
            $table->string('density')->nullable();
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
        Schema::dropIfExists('equipment_gases');
    }
};
