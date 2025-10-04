<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Notion\Models\NotionPage;
use App\Modules\Todoist\Actions\TodoistProjectSelectAction;
use App\Utilities\ValidationUtility;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotionPageUpdateAction
{
    protected ValidationUtility $validationUtility;

    protected TodoistProjectSelectAction $projectSelectAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->projectSelectAction = app(TodoistProjectSelectAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(NotionPage $page, array $payload): NotionPage
    {
        $title = data_get($payload, 'properties.title.title.0.plain_text');
        // TODO considerations for deleted and archived

        Log::notice("NotionPageUpdateAction updating NotionPage $page->id");
        $page->update([
            'title' => $title,
        ]);

        return $page;
    }
}
