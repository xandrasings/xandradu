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
        Schema::create('todoist_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(table: 'todoist_users')->cascadeOnDelete();
            $table->string('access_token', 256);
            $table->string('sync_token', 512)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todoist_accounts');
    }
};
