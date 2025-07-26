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
        Schema::create('todoist_project_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('todoist_project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('todoist_user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('parent_project_id')->nullable()->constrained(table: 'todoist_projects')->cascadeOnDelete();
            $table->integer('parent_project_rank')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todoist_project_user');
    }
};
