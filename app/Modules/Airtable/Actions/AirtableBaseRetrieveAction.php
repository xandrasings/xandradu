<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableBase;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableBaseRetrieveAction
{
    /**
     * @throws Exception
     */
    public function handle(?string $externalId): ?AirtableBase
    {
        Log::info('executing AirtableBaseRetrieveAction', ['externalId' => $externalId]);

        if (is_null($externalId)) {
            return null;
        }

        $bases = AirtableBase::where('external_id', $externalId)->get();

        if (count($bases) > 1) {
            throw new Exception('Too many matching records found');
        }

        if ($bases->isEmpty()) {
            return null;
        }

        return $bases->first();
    }
}
