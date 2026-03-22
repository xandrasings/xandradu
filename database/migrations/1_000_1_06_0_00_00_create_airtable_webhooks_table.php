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
        Schema::create('airtable_webhooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('base_id')->constrained(table: 'airtable_bases')->cascadeOnDelete();
            $table->string('external_id', 32)->nullable();
            $table->string('encoded_mac_secret', 2048)->nullable();
            $table->dateTime('expires_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airtable_webhooks');
    }
};
