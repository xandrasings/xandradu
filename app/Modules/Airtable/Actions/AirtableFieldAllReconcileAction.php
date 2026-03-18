<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableBase;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableTable;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableFieldAllReconcileAction
{
    protected AirtableFieldReconcileAction $fieldReconcileAction;

    public function __construct()
    {
        $this->fieldReconcileAction = app(AirtableFieldReconcileAction::class);
    }

    /**
     * @param Collection<AirtableFieldResourceResponseDto> $fieldResourceResponseDtos
     * @return Collection<AirtableField>
     * @throws Exception
     */
    public function handle(Collection $fieldResourceResponseDtos, AirtableTable $table): Collection
    {
        Log::info('executing AirtableFieldAllReconcileAction');

        $fieldResourceResponseDtos->each(function (AirtableFieldResourceResponseDto $fieldResourceResponseDto, int $key) {
            $fieldResourceResponseDto->rank = $key + 1;
        });

        $fields = $fieldResourceResponseDtos->map(function ($fieldResourceResponseDto) use ($table) {
            return $this->fieldReconcileAction->handle($fieldResourceResponseDto, $table);
        });

        // TODO confirm no offset logic at play when table schema gets grabbed
        $table->fields()
            ->whereNotNull('external_id')
            ->whereNotIn('id', $fields->pluck('id'))
            ->get()
            ->each(function (AirtableField $field) {
                $field->delete();
                Log::notice('deleted AirtableField.', ['field' => $field]);
            });

        return $fields;
    }
}
