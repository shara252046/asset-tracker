<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->uuid('qr_token')->unique();
            $table->string('name');
            $table->enum('category', ['ac', 'computer', 'printer', 'vehicle']);
            $table->string('brand')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('location')->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_price', 12, 2)->default(0);
            $table->date('warranty_end_date')->nullable();
            $table->enum('status', ['active', 'under_maintenance', 'retired'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};