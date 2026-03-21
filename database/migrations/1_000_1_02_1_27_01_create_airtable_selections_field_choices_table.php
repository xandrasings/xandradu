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
        Schema::create('airtable_selections_field_choices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('selections_field_id')->constrained(table: 'airtable_selections_fields')->cascadeOnDelete();
            $table->unsignedSmallInteger('rank');
            $table->string('external_id', 32)->nullable();
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
        Schema::dropIfExists('airtable_selections_field_choices');
    }
};
