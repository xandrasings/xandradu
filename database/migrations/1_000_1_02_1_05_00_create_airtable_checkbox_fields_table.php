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
        Schema::create('airtable_checkbox_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('field_id')->constrained(table: 'airtable_fields')->cascadeOnDelete();
            $table->string('color', 16);
            $table->string('icon', 16);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airtable_checkbox_fields');
    }
};
