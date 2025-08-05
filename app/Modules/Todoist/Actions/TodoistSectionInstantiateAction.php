<?php

namespace App\Modules\Todoist\Actions;

use App\Modules\Todoist\Models\TodoistSection;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistSectionInstantiateAction
{
    protected ValidationUtility $validationUtility;

    protected TodoistProjectSelectAction $projectSelectAction;

    protected TodoistNodeInstantiateAction $nodeInstantiateAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->projectSelectAction = app(TodoistProjectSelectAction::class);
        $this->nodeInstantiateAction = app(TodoistNodeInstantiateAction::class);
    }

    public function handle(array $payload): ?TodoistSection
    {
        $name = data_get($payload, 'name');
        $projectId = data_get($payload, 'v2_project_id');
        $rank = data_get($payload, 'section_order');
        $id = data_get($payload, 'v2_id');
        $isArchived = data_get($payload, 'is_archived');
        $isDeleted = data_get($payload, 'is_deleted');
        // TODO deal with is_archived and is_deleted
        if (!$this->validationUtility->containsNoNulls([$name, $projectId, $rank, $id])) {
            Log::warning("TodoistSectionInitializeAction couldn't proceed due to a missing non-nullable variable.");
            return null;
        }

        $project = $this->projectSelectAction->handle($projectId);
        if (!$this->validationUtility->containsNoNulls([$project])) {
            Log::warning("TodoistSectionInitializeAction couldn't proceed due to a missing non-nullable variable.");
            return null;
        }

        $node = $this->nodeInstantiateAction->handle();
        if (!$this->validationUtility->containsNoNulls([$node])) {
            Log::warning("TodoistSectionInitializeAction couldn't proceed due to a missing non-nullable variable.");
            return null;
        }

        try {
            Log::notice("TodoistSectionInitializeAction creating TodoistSection from TodoistNode $node->id, TodoistProject $project->id, rank $rank, external id $id, name $name.");
            return TodoistSection::create([
                'location_reference_id' => $node->id,
                'project_id' => $project->id,
                'rank' => $rank,
                'external_id' => $id,
                'name' => $name
            ]);
        } catch (Throwable $exception) {
            Log::warning("TodoistSectionInitializeAction failed with exception {$exception->getMessage()}.");
            return null;
        }
    }
}
