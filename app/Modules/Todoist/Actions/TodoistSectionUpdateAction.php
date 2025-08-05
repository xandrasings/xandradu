<?php

namespace App\Modules\Todoist\Actions;

use App\Modules\Todoist\Models\TodoistSection;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistSectionUpdateAction
{
    protected ValidationUtility $validationUtility;

    protected TodoistProjectSelectAction $projectSelectAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->projectSelectAction = app(TodoistProjectSelectAction::class);
    }

    public function handle(TodoistSection $section, array $payload): ?TodoistSection
    {
        $name = data_get($payload, 'name');
        $projectId = data_get($payload, 'v2_project_id');
        $rank = data_get($payload, 'section_order');
        $isArchived = data_get($payload, 'is_archived');
        $isDeleted = data_get($payload, 'is_deleted');
        // TODO deal with is_archived and is_deleted

        if (!$this->validationUtility->containsNoNulls([$name, $projectId, $rank])) {
            Log::warning("TodoistSectionUpdateAction couldn't proceed due to a missing non-nullable variable.");
            return null;
        }

        $project = $this->projectSelectAction->handle($projectId);
        if (!$this->validationUtility->containsNoNulls([$project])) {
            Log::warning("TodoistSectionUpdateAction couldn't proceed due to a missing non-nullable variable.");
            return null;
        }

        try {
            Log::notice("TodoistSectionUpdateAction updating TodoistSection $section->id.");
            $section->update([
                'project_id' => $project->id,
                'rank' => $rank,
                'name' => $name,
            ]);
        } catch (Throwable $exception) {
            Log::warning("TodoistSectionUpdateAction failed with exception {$exception->getMessage()}.");
            return null;
        }

        return $section;
    }
}
