<?php

use App\Modules\Airtable\Controllers\AirtableController;
use Illuminate\Support\Facades\Route;

Route::post('/webhooks/airtable', [AirtableController::class, 'handleWebhook']);
