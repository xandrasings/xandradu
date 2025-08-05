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
        Schema::create('notion_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('node_id')->constrained(table: 'notion_nodes')->cascadeOnDelete();
            $table->foreignId('location_id')->constrained(table: 'notion_nodes')->cascadeOnDelete();
            $table->string('external_id', 32)->nullable();
            $table->string('title', 32)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notion_pages');
    }
};
