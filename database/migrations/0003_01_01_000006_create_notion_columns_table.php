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
        Schema::create('notion_columns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_source_id')->constrained(table: 'notion_data_sources')->cascadeOnDelete();
            $table->integer('rank')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notion_columns');
    }
};
