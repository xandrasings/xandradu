<?php

namespace App\Modules\Airtable\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AirtableController extends Controller
{
    public function handleWebhook(Request $request): JsonResponse
    {
        Log::notice("received Airtable webhook.", [$request]);

        return response()->json([
            'status' => 'success',
        ]);
    }
}
