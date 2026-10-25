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
       Schema::create('tickets', function (Blueprint $table) {
    $table->id();
    $table->foreignId('asset_id')->constrained()->cascadeOnDelete();
    $table->foreignId('issue_id')->nullable()->constrained()->nullOnDelete(); // null for auto-generated maintenance tickets
    $table->foreignId('technician_id')->nullable()->constrained('users')->nullOnDelete();
    $table->string('type')->default('corrective'); // corrective, preventive
    $table->string('status')->default('open'); // open, in_progress, resolved
    $table->text('resolution_note')->nullable();
    $table->decimal('cost', 10, 2)->nullable();
    $table->timestamp('resolved_at')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
