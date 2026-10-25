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
        Schema::create('issues', function (Blueprint $table) {
    $table->id();
    $table->foreignId('asset_id')->constrained()->cascadeOnDelete();
    $table->text('description');
    $table->string('photo_path')->nullable();
    $table->string('urgency')->default('medium'); // low, medium, high
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
