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
        Schema::create('workers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code_number')->unique();
            $table->string('name')->index();
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
            $table->string('bi')->unique()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
