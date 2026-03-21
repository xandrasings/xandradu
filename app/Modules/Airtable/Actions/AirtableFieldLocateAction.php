<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableFieldLocateAction
{
    protected AirtableFieldRetrieveAction $retrieveAction;

    public function __construct()
    {
        $this->retrieveAction = app(AirtableFieldRetrieveAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(string $externalId): AirtableField
    {
        Log::info('executing AirtableFieldLocateAction', ['externalId' => $externalId]);

        $field = $this->retrieveAction->handle($externalId);

        if (is_null($field)) {
            throw new Exception('No matching record found.');
        }

        return $field;
    }
}
