<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableFormulaFieldField;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableFormulaFieldFieldAllTrashAction
{
    protected AirtableFormulaFieldFieldTrashAction $formulaFieldFieldTrashAction;

    public function __construct()
    {
        $this->formulaFieldFieldTrashAction = app(AirtableFormulaFieldFieldTrashAction::class);
    }

    /**
     * @param  Collection<AirtableFormulaFieldField>  $formulaFieldFields
     *
     * @throws Exception
     */
    public function handle(Collection $formulaFieldFields): void
    {
        Log::info('executing AirtableFormulaFieldFieldAllTrashAction');

        $formulaFieldFields
            ->each(function (AirtableFormulaFieldField $formulaFieldField) {
                $this->formulaFieldFieldTrashAction->handle($formulaFieldField);
            });
    }
}
