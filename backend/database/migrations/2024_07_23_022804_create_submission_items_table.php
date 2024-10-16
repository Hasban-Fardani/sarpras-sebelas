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
        Schema::create('submission_items', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('submission_session_id')->nullable();
            $table->enum('status', ['diajukan', 'disetujui', 'ditolak', 'draf'])->default('diajukan');
            $table->string('regarding');
            $table->text('note')->nullable();

            $table->foreign('division_id')->references('id')->on('employees')->cascadeOnDelete();
            $table->foreign('submission_session_id')->references('id')->on('submission_sessions')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission_items');
    }
};
