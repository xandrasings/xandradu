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
        Schema::create('airtable_date_time_updated_at_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('updated_at_field_id')->constrained(table: 'airtable_updated_at_fields')->cascadeOnDelete();
            $table->string('time_format', 8);
            $table->string('time_zone', 32);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airtable_updated_at_fields');
    }
};
