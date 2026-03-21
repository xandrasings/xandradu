<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableView;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableViewTrashAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableView $view): void
    {
        Log::info('executing AirtableViewTrashAction');

        $view->rank = 0;
        $view->save();
        Log::notice('unranked AirtableView.', ['view' => $view]);

        $view->delete();
        Log::notice('deleted AirtableView.', ['view' => $view]);
    }
}
