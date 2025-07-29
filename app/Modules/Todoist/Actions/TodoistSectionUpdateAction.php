<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistAccount;
use App\Models\TodoistSection;
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

    public function handle(TodoistSection $section, array $sectionPayload): ?TodoistSection
    {
        $name = data_get($sectionPayload, 'name');
        $projectId = data_get($sectionPayload, 'v2_project_id');
        $rank = data_get($sectionPayload, 'section_order');
        $id = data_get($sectionPayload, 'v2_id');

        if (!$this->validationUtility->containsNoNulls([$name, $projectId, $rank, $id])) {
            Log::warning("TodoistSectionUpdateAction couldn't proceed due to a missing non-nullable variable");
            return null;
        }

        $project = $this->projectSelectAction->handle($projectId);
        if (is_null($project)) {
            Log::warning("TodoistSectionUpdateAction failed due to missing project.}");
            return null;
        }

        try {
            Log::notice("TodoistSectionUpdateAction updating TodoistSection $id");
            $section->update([
                'project_id' => $project->id,
                'rank' => $rank,
                'name' => $name,
            ]);
        } catch (Throwable $exception) {
            Log::warning("TodoistSectionUpdateAction failed with exception {$exception->getMessage()}");
            return null;
        }

        return $section;
    }
}
