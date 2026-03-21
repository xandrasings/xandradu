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
        Schema::create('airtable_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('table_id')->constrained(table: 'airtable_tables')->cascadeOnDelete();
            $table->unsignedSmallInteger('rank');
            $table->string('external_id', 32)->nullable();
            $table->string('name', 32);
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
        Schema::dropIfExists('airtable_views');
    }
};
