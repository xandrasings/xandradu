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
        Schema::dropIfExists('todoist_users');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('todoist_users', function (Blueprint $table) {
            $table->id();
            $table->string('todoist_id', 16);
            $table->foreignId('email_address_id')->constrained()->cascadeOnDelete();
            $table->string('username', 64);
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
