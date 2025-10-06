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
        Schema::create('todoist_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('node_id')->constrained(table: 'todoist_nodes')->cascadeOnDelete();
            $table->string('external_id', 16)->nullable();
            $table->string('name', 32);
            $table->foreignId('color_id')->constrained(table: 'todoist_colors')->cascadeOnDelete();
            $table->boolean('is_favorite')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todoist_projects');
    }
};
