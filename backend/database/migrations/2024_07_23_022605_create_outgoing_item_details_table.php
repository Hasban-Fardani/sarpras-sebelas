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
        Schema::create('outgoing_item_details', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('outgoing_item_id');
            $table->string('item_id');
            $table->integer('qty');
            
            $table->foreign('item_id')->references('id')->on('items')->cascadeOnDelete();
            $table->foreign('outgoing_item_id')->references('id')->on('outgoing_items')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoing_item_details');
        Schema::dropIfExists('item_out_details');
    }
};
