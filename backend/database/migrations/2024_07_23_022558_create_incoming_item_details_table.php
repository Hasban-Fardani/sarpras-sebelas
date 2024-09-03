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
        Schema::create('incoming_items_details', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('incoming_item_id');
            $table->string('item_id');
            $table->integer('qty');
            
            $table->foreign('id')->references('id')->on('incoming_items')->cascadeOnDelete();
            $table->foreign('item_id')->references('id')->on('items')->cascadeOnDelete();
            $table->foreign('incoming_item_id')->references('id')->on('incoming_items')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incoming_item_details');
        Schema::dropIfExists('item_in_details');
    }
};
