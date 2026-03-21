<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableView;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableViewAllTrashAction
{
    protected AirtableViewTrashAction $viewTrashAction;

    public function __construct()
    {
        $this->viewTrashAction = app(AirtableViewTrashAction::class);
    }

    /**
     * @param  Collection<AirtableView>  $views
     *
     * @throws Exception
     */
    public function handle(Collection $views): void
    {
        Log::info('executing AirtableViewAllTrashAction');

        $views
            ->each(function (AirtableView $view) {
                $this->viewTrashAction->handle($view);
            });
    }
}
