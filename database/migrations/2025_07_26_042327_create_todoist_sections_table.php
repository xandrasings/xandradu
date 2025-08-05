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
        Schema::create('todoist_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('node_id')->constrained(table: 'todoist_nodes')->cascadeOnDelete();
            $table->foreignId('project_id')->nullable()->constrained(table: 'todoist_projects')->cascadeOnDelete();
            $table->integer('rank')->default(0);
            $table->string('external_id', 16)->nullable();
            $table->string('name', 64);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todoist_sections');
    }
};
