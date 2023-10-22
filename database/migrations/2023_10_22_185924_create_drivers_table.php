<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fleet_id');
            $table->string('aadhar');
            $table->enum('status', ['Available','On Duty','On Vacation']);
            $table->unsignedInteger('rating');
            $table->timestamps();
            $table->foreign('fleet_id')->references('id')->on('fleets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('drivers');
    }
};
