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
        Schema::create('airtable_ai_text_field_prompt_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ai_text_field_id')->nullable()->constrained(table: 'airtable_ai_text_fields', indexName: 'airtable_ai_field_components_ai_text_field_id_foreign')->cascadeOnDelete();
            $table->unsignedTinyInteger('rank');
            $table->string('type', 8);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airtable_ai_text_field_prompt_components');
    }
};
