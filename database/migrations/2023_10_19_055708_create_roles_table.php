<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        // Insert records into the 'roles' table
        $now = Carbon::now();

        DB::table('roles')->insert([
            ['name' => 'Admin', 'description' => 'Administrator Role', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Employee', 'description' => 'Employee Role', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Driver', 'description' => 'Driver Role', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Customer', 'description' => 'Customer Role', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
