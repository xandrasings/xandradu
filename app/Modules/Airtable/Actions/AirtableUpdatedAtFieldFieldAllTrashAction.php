<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableUpdatedAtFieldField;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableUpdatedAtFieldFieldAllTrashAction
{
    protected AirtableUpdatedAtFieldFieldTrashAction $updatedAtFieldFieldTrashAction;

    public function __construct()
    {
        $this->updatedAtFieldFieldTrashAction = app(AirtableUpdatedAtFieldFieldTrashAction::class);
    }

    /**
     * @param  Collection<AirtableUpdatedAtFieldField>  $updatedAtFieldFields
     *
     * @throws Exception
     */
    public function handle(Collection $updatedAtFieldFields): void
    {
        Log::info('executing AirtableUpdatedAtFieldFieldAllTrashAction');

        $updatedAtFieldFields->each(function (AirtableUpdatedAtFieldField $updatedAtFieldField) {
            $this->updatedAtFieldFieldTrashAction->handle($updatedAtFieldField);
        });
    }
}
