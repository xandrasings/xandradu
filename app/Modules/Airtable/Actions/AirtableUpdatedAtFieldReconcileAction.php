<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableUpdatedAtFieldResourceResponseDto;
use App\Modules\Airtable\Enums\AirtableDateTimeTypeEnum;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableUpdatedAtField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableUpdatedAtFieldReconcileAction
{
    protected AirtableDateUpdatedAtFieldReconcileAction $dateUpdatedAtFieldReconcileAction;

    protected AirtableDateTimeUpdatedAtFieldReconcileAction $dateTimeUpdatedAtFieldReconcileAction;

    protected AirtableUpdatedAtFieldFieldAllReconcileAction $updatedAtFieldFieldAllReconcileAction;

    public function __construct()
    {
        $this->dateUpdatedAtFieldReconcileAction = app(AirtableDateUpdatedAtFieldReconcileAction::class);

        $this->dateTimeUpdatedAtFieldReconcileAction = app(AirtableDateTimeUpdatedAtFieldReconcileAction::class);

        $this->updatedAtFieldFieldAllReconcileAction = app(AirtableUpdatedAtFieldFieldAllReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableUpdatedAtFieldResourceResponseDto $updatedAtFieldResourceResponseDto, AirtableField $field): AirtableUpdatedAtField
    {
        Log::info('executing AirtableUpdatedAtFieldReconcileAction', ['updatedAtFieldResourceResponseDto' => $updatedAtFieldResourceResponseDto, 'field' => $field]);

        $updatedAtField = $field->updatedAtField()->updateOrCreate(
            [],
            is_null($updatedAtFieldResourceResponseDto->options->result) ? [] : array_merge(
                $updatedAtFieldResourceResponseDto->options->result->except('options')->toArray(),
                $updatedAtFieldResourceResponseDto->options->result->options->dateFormat->toArray()
            )
        );
        Log::notice('created or updated AirtableUpdatedAtField', ['updatedAtField' => $updatedAtField, 'updatedAtFieldResourceResponseDto' => $updatedAtFieldResourceResponseDto]);

        if (! is_null($updatedAtFieldResourceResponseDto->options->result)) {
            match ($updatedAtFieldResourceResponseDto->options->result->type) {
                AirtableDateTimeTypeEnum::DATE => $this->dateUpdatedAtFieldReconcileAction->handle($updatedAtFieldResourceResponseDto->options->result, $updatedAtField),
                AirtableDateTimeTypeEnum::DATE_TIME => $this->dateTimeUpdatedAtFieldReconcileAction->handle($updatedAtFieldResourceResponseDto->options->result, $updatedAtField),
            };
        }

        $this->updatedAtFieldFieldAllReconcileAction->handle($updatedAtFieldResourceResponseDto->options->referencedFieldIds, $updatedAtField);

        return $updatedAtField;
    }
}
