<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableCreatedAtFieldOptionsDateTimeResultResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableCreatedAtFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableCreatedAtField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableCreatedAtFieldReconcileAction
{
    protected AirtableDateTimeCreatedAtFieldAllReconcileAction $dateTimeCreatedAtFieldAllReconcileAction;

    public function __construct()
    {
        $this->dateTimeCreatedAtFieldAllReconcileAction = app(AirtableDateTimeCreatedAtFieldAllReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableFieldResourceResponseDto $fieldResourceResponseDto, AirtableField $field):  AirtableCreatedAtField
    {
        Log::info('executing AirtableCreatedAtFieldReconcileAction', ['fieldResourceResponseDto' => $fieldResourceResponseDto, 'field' => $field]);

        if (!($fieldResourceResponseDto instanceof AirtableCreatedAtFieldResourceResponseDto)) {
            Log::error('Wrong field type encountered.', ['fieldResourceResponseDto' => $fieldResourceResponseDto]);
            throw new Exception('Wrong field type encountered.');
        }

        $createdAtField = $field->createdAtField()->updateOrCreate(
            [],
            $fieldResourceResponseDto->options->result->options->dateFormat->only('format')->toArray(),
        );
        Log::notice('created or updated AirtableCreatedAtField', ['createdAtField' => $createdAtField, 'fieldResourceResponseDto' => $fieldResourceResponseDto]);

        $this->dateTimeCreatedAtFieldAllReconcileAction->handle($fieldResourceResponseDto->options->result, $createdAtField);

        return $createdAtField;
    }
}
