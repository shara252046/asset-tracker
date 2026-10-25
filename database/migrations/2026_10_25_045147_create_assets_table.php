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
        Schema::create('assets', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('category'); // AC, computer, printer, vehicle
    $table->string('brand')->nullable();
    $table->string('serial_number')->unique();
    $table->string('location');
    $table->date('purchase_date');
    $table->decimal('purchase_price', 12, 2)->nullable();
    $table->date('warranty_end_date')->nullable();
    $table->string('status')->default('active'); // active, under_repair, retired
    $table->integer('service_interval_days')->default(90); // AC default 90 days
    $table->date('next_service_due')->nullable(); // auto-updated after service completion
    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
