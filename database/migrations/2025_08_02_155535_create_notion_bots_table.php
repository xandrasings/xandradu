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
        Schema::create('notion_bots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workspace_id')->constrained(table: 'notion_workspaces')->cascadeOnDelete();
            $table->string('external_id', 64);
            $table->string('name', 32);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notion_bots');
    }
};
