<?php

namespace App\Modules\Notion\Actions;

use App\Models\NotionNode;
use App\Models\NotionPage;
use App\Modules\Todoist\Actions\TodoistProjectSelectAction;
use App\Modules\Todoist\Actions\TodoistTaskLocationCreateAction;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotionPageInstantiateAction
{
    protected ValidationUtility $validationUtility;

    protected TodoistProjectSelectAction $projectSelectAction;

    protected TodoistTaskLocationCreateAction $taskLocationCreateAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->projectSelectAction = app(TodoistProjectSelectAction::class);
        $this->taskLocationCreateAction = app(TodoistTaskLocationCreateAction::class);
    }

    public function handle(array $payload): ?NotionPage
    {
        $id = data_get($payload, 'id');
        $title = data_get($payload, 'properties.title.title.0.plain_text');

        if (! $this->validationUtility->containsNoNulls([$id, $title])) {
            Log::warning("NotionPageInstantiateAction couldn't proceed due to a missing non-nullable variable");
            return null;
        }

        try {
            // TODO separate out
            $node = NotionNode::create([]);

            Log::notice("NotionPageInstantiateAction creating NotionPage from $title $id");
            return NotionPage::create([
                'external_id' => $id,
                'node_id' => $node->id,
                'title' => $title
            ]);
        } catch (Throwable $exception) {
            Log::warning("NotionPageInstantiateAction failed with exception {$exception->getMessage()}");
            return null;
        }
    }
}
