<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableCreatedAtFieldResourceResponseDto;
use App\Modules\Airtable\Enums\AirtableDateTimeTypeEnum;
use App\Modules\Airtable\Models\AirtableCreatedAtField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableCreatedAtFieldReconcileAction
{
    protected AirtableDateCreatedAtFieldReconcileAction $dateCreatedAtFieldReconcileAction;

    protected AirtableDateTimeCreatedAtFieldReconcileAction $dateTimeCreatedAtFieldReconcileAction;

    public function __construct()
    {
        $this->dateCreatedAtFieldReconcileAction = app(AirtableDateCreatedAtFieldReconcileAction::class);

        $this->dateTimeCreatedAtFieldReconcileAction = app(AirtableDateTimeCreatedAtFieldReconcileAction::class);
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

        match ($createdAtFieldResourceResponseDto->options->result->type) {
            AirtableDateTimeTypeEnum::DATE => $this->dateCreatedAtFieldReconcileAction->handle($createdAtFieldResourceResponseDto->options->result, $createdAtField),
            AirtableDateTimeTypeEnum::DATE_TIME => $this->dateTimeCreatedAtFieldReconcileAction->handle($createdAtFieldResourceResponseDto->options->result, $createdAtField),
        };

        return $createdAtField;
    }
}
