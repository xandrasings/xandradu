<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableFieldRetrieveAction
{
    /**
     * @throws Exception
     */
    public function handle(?string $externalId): ?AirtableField
    {
        Log::info('executing AirtableFieldRetrieveAction', ['externalId' => $externalId]);

        if (is_null($externalId)) {
            return null;
        }

        $fields = AirtableField::where('external_id', $externalId)->get();

        if (sizeof($fields) > 1) {
            Throw new Exception('Too many matching records found');
        }

        if ($fields->isEmpty()) {
            return null;
        }

        return $fields->first();
    }
}
