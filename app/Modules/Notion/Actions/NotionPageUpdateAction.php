<?php

namespace App\Modules\Notion\Actions;

use App\Models\NotionPage;
use App\Modules\Todoist\Actions\TodoistProjectSelectAction;
use App\Utilities\ValidationUtility;
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

    public function handle(NotionPage $page, array $payload): ?NotionPage
    {
        $title = data_get($payload, 'properties.title.title.0.plain_text');
        // TODO considerations for deleted and archived

        try {
            Log::notice("NotionPageUpdateAction updating NotionPage $page->id");
            $page->update([
                'title' => $title,
            ]);
        } catch (Throwable $exception) {
            Log::warning("NotionPageUpdateAction failed with exception {$exception->getMessage()}.");
            return null;
        }

        return $page;
    }
}
