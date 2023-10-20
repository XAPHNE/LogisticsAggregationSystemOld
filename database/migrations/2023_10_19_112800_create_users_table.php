<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->enum('gender', ['Male','Female','Other'])->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('number')->nullable();
            $table->string('city')->nullable();
            $table->string('ZIP')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken()->unique();
            $table->enum('status', ['Active','Inactive'])->default('Inactive');
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('roles');
        });

        // Insert records into the 'roles' table
        $now = Carbon::now();

        DB::table('users')->insert([
            ['first_name'=> 'Admin',
            'last_name'=> 'User',
            'email'=> 'admin@last.com',
            'password' => Hash::make('admin123'),
            'role_id'=> 1,
            'created_at'=> $now,
            'updated_at'=> $now],
            ['first_name'=> 'Employee',
            'last_name'=> 'User',
            'email'=> 'employee@last.com',
            'password' => Hash::make('employee123'),
            'role_id'=> 2,
            'created_at'=> $now,
            'updated_at'=> $now],
            ['first_name'=> 'Driver',
            'last_name'=> 'User',
            'email'=> 'driver@last.com',
            'password' => Hash::make('driver123'),
            'role_id'=> 3,
            'created_at'=> $now,
            'updated_at'=> $now],
            ['first_name'=> 'Customer',
            'last_name'=> 'User',
            'email'=> 'customer@last.com',
            'password' => Hash::make('customer123'),
            'role_id'=> 4,
            'created_at'=> $now,
            'updated_at'=> $now],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }
}
