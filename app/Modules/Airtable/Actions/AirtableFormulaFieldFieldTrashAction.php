<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableFormulaFieldField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableFormulaFieldFieldTrashAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableFormulaFieldField $formulaFieldField): void
    {
        Log::info('executing AirtableFormulaFieldFieldTrashAction');

        $formulaFieldField->delete();
        Log::notice('deleted AirtableFormulaFieldField.', ['formulaFieldField' => $formulaFieldField]);
    }
}
