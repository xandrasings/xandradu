<?php

namespace App\Modules\Airtable\Jobs;

use App\Modules\Airtable\Actions\AirtableTypedFieldReconcileAction;
use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AirtableTypedFieldReconcileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected AirtableTypedFieldReconcileAction $typedFieldReconcileAction;

    protected AirtableFieldResourceResponseDto $fieldResourceResponseDto;

    protected AirtableField $field;

    public function __construct(AirtableFieldResourceResponseDto $fieldResourceResponseDto, AirtableField $field)
    {
        $this->typedFieldReconcileAction = app(AirtableTypedFieldReconcileAction::class);
        $this->fieldResourceResponseDto = $fieldResourceResponseDto;
        $this->field = $field;
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $this->typedFieldReconcileAction->handle($this->fieldResourceResponseDto, $this->field);
    }
}
