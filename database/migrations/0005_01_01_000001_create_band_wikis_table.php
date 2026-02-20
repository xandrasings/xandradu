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
        Schema::create('band_wikis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('band_id')->unique()->constrained()->cascadeOnDelete();
            $table->foreignId('notion_node_id')->unique()->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('band_wikis');
    }
};
