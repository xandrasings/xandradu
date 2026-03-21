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
        Schema::create('airtable_lookup_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('field_id')->nullable()->constrained(table: 'airtable_fields')->cascadeOnDelete();
            $table->foreignId('referenced_field_id')->nullable()->constrained(table: 'airtable_fields')->nullOnDelete();
            $table->foreignId('targeted_field_id')->nullable()->constrained(table: 'airtable_fields')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airtable_lookup_fields');
    }
};
