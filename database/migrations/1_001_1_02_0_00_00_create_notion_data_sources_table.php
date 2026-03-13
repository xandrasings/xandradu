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
        Schema::create('notion_data_sources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('database_id')->constrained(table: 'notion_databases')->cascadeOnDelete();
            $table->integer('rank')->default(0);
            $table->string('external_id', 32)->nullable();
            $table->string('title', 32)->nullable();
            $table->foreignId('icon_id')->nullable()->constrained(table: 'stored_files')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notion_data_sources');
    }
};
