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
        Schema::create('airtable_sync_source_field_choices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sync_source_field_id')->nullable()->constrained(table: 'airtable_sync_source_fields')->cascadeOnDelete();
            $table->string('external_id', 32)->nullable(); // TODO sync source may not be nullable in the same way, consider when writing syncUp
            $table->string('name', 64);
            $table->string('color', 16)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airtable_sync_source_field_choices');
    }
};
