<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableCreatedAtFieldResourceResponseDto;
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
    public function handle(AirtableCreatedAtFieldResourceResponseDto $createdAtFieldResourceResponseDto, AirtableField $field):  AirtableCreatedAtField
    {
        Log::info('executing AirtableCreatedAtFieldReconcileAction', ['createdAtFieldResourceResponseDto' => $createdAtFieldResourceResponseDto, 'field' => $field]);

        $createdAtField = $field->createdAtField()->updateOrCreate(
            [],
            $createdAtFieldResourceResponseDto->options->result->options->dateFormat->only('format')->toArray(),
        );
        Log::notice('created or updated AirtableCreatedAtField', ['createdAtField' => $createdAtField, 'createdAtFieldResourceResponseDto' => $createdAtFieldResourceResponseDto]);

        $this->dateTimeCreatedAtFieldAllReconcileAction->handle($createdAtFieldResourceResponseDto->options->result, $createdAtField);

        return $createdAtField;
    }
}
