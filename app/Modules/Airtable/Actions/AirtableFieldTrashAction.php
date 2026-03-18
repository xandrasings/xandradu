<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableFieldTrashAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableField $field): void
    {
        Log::info('executing AirtableFieldTrashAction');

        $field->rank = 0;
        $field->save();
        Log::notice('unranked AirtableField.', ['field' => $field]);

        $field->delete();
        Log::notice('deleted AirtableField.', ['field' => $field]);
    }
}
