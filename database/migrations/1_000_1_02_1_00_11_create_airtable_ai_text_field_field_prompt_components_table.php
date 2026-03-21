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
        Schema::create('airtable_ai_text_field_field_prompt_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prompt_component_id')->nullable()->constrained(table: 'airtable_ai_text_field_prompt_components', indexName: 'airtable_ai_field_field_components_ai_text_field_id_foreign')->cascadeOnDelete();
            $table->foreignId('referenced_field_id')->nullable()->constrained(table: 'airtable_fields', indexName: 'airtable_ai_field_field_components_referenced_field_id_foreign')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airtable_ai_text_field_field_prompt_components');
    }
};
