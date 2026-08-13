<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('address', function (Blueprint $table) { 
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete()->unique();
            $table->string('FullName');
            $table->string('email');
            $table->string('phone_number')->unique()->cascadeOnUpdate();
            $table->string('main_address');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
