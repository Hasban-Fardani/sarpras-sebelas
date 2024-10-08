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
        Schema::create('request_items', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->unsignedBigInteger('employee_id');
            $table->enum('status', ['diajukan', 'disetujui', 'ditolak', 'draf'])->default('diajukan');
            $table->foreign('employee_id')->references('id')->on('employees')->cascadeOnDelete();
            $table->text('note')->nullable();
            $table->string('regarding');
            $table->string('characteristic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_items');
    }
};
