<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_placed_by');
            $table->string('source_city');
            $table->string('destination_city');
            $table->unsignedDouble('distance');
            $table->enum('required_fleet_type', ['Truck 4 Wheels','Truck 6 Wheels','Truck 10 Wheels','Truck 18 Wheels']);
            $table->unsignedDouble('weight');
            $table->date('order_placed_on');
            $table->date('load_by');
            $table->unsignedDouble('price');
            $table->enum('status', ['Open','Accepted','Intransit','Completed','Cancelled']);
            $table->timestamps();
            $table->foreign('order_placed_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('orders');
    }
};
