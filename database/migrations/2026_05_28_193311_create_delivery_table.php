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
        Schema::create('delivery', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_id')->constrained()->cascadeOnDelete();
            $table->date('expected_delivery_date')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->tinyInteger('delivery_status')->default(0);// 0 pending, 1 out for delivery, 2 delivered, 3 failed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery');
    }
};
