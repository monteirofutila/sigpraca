<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code_number')->unique();
            $table->string('name');
            $table->string('user_name')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('photo')->nullable();
            $table->string('phone_mobile')->nullable();
            $table->string('phone_other')->nullable();
            $table->string('address_country')->nullable();
            $table->string('address_state')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_street')->nullable();
            $table->date('date_birth')->nullable();
            $table->enum('gender', ['F', 'M']);
            $table->char('bi', 14)->unique()->nullable();
            $table->text('description')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};