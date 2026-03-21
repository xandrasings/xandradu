<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableFieldAllTrashAction
{
    protected AirtableFieldTrashAction $fieldTrashAction;

    public function __construct()
    {
        $this->fieldTrashAction = app(AirtableFieldTrashAction::class);
    }

    /**
     * @param  Collection<AirtableField>  $fields
     *
     * @throws Exception
     */
    public function handle(Collection $fields): void
    {
        Log::info('executing AirtableFieldAllTrashAction');

        $fields
            ->each(function (AirtableField $field) {
                $this->fieldTrashAction->handle($field);
            });
    }
}
