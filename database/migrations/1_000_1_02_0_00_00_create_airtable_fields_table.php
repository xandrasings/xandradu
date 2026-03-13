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
        Schema::create('airtable_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('table_id')->nullable()->constrained(table: 'airtable_tables')->cascadeOnDelete();
            $table->string('external_id', 32)->nullable();
            $table->string('name', 32);
            $table->string('description', 256)->nullable();
            $table->string('type', 32);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airtable_fields');
    }
};
