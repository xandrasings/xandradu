<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Jobs\AirtableTypedFieldReconcileJob;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableTable;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableFieldResourceResponseDto $fieldResourceResponseDto, AirtableTable $table): AirtableField
    {
        Log::info('executing AirtableFieldReconcileAction', ['fieldResourceResponseDto' => $fieldResourceResponseDto, 'table' => $table]);

        $field = $table->fields()->updateOrCreate(
            $fieldResourceResponseDto->only('id')->toArray(),
            $fieldResourceResponseDto->except('id', 'options')->toArray(),
        );
        Log::notice('created or updated AirtableField', ['field' => $field, 'fieldResourceResponseDto' => $fieldResourceResponseDto]);

        dispatch(new AirtableTypedFieldReconcileJob($fieldResourceResponseDto, $field));

        return $field;
    }
}
