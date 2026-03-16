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
        Schema::create('airtable_currency_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('field_id')->nullable()->constrained(table: 'airtable_fields')->cascadeOnDelete();
            $table->unsignedTinyInteger('precision');
            $table->string('symbol', 8);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airtable_currency_fields');
    }
};
