<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('fleets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fleet_owner_id');
            $table->string('registration_num');
            $table->enum('type', ['Truck 4 Wheels','Truck 6 Wheels','Truck 10 Wheels','Truck 18 Wheels']);
            $table->enum('permit_type', ['All India','All Assam','Assam West Bengal']);
            $table->date('insurance_expiry');
            $table->date('pollution_expiry');
            $table->date('fitness_expiry');
            $table->timestamps();
            $table->foreign('fleet_owner_id')->references('id')->on('fleet_owners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('fleets');
    }
};
