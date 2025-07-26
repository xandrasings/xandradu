<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistAccount;
use App\Models\TodoistSection;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistSectionCreateAction
{
    protected ValidationUtility $validationUtility;

    protected TodoistProjectSelectAction $projectSelectAction;

    protected TodoistTaskLocationCreateAction $taskLocationCreateAction;

    public function __construct()
    {
        $this->validationUtility = new ValidationUtility();
        $this->projectSelectAction = new TodoistProjectSelectAction();
        $this->taskLocationCreateAction = new TodoistTaskLocationCreateAction();
    }

    public function handle(array $sectionPayload): ?TodoistSection
    {
        $name = data_get($sectionPayload, 'name');
        $projectId = data_get($sectionPayload, 'v2_project_id');
        $rank = data_get($sectionPayload, 'section_order');
        $id = data_get($sectionPayload, 'v2_id');

        if (! $this->validationUtility->containsNoNulls([$name, $projectId, $rank, $id])) {
            Log::warning("TodoistSectionCreateAction couldn't proceed due to a missing non-nullable variable.");
            return null;
        }

        $project = $this->projectSelectAction->handle($projectId);
        if (is_null($project)) {
            Log::warning("TodoistSectionUpdateAction failed due to missing project.}");
            return null;
        }

        $taskLocation = $this->taskLocationCreateAction->handle();

        if (is_null($taskLocation)) {
            Log::warning("TodoistSectionCreateAction failed due to task location not being successfully created.");
            return null;
        }

        try {
            Log::notice("TodoistSectionCreateAction creating TodoistSection from $name $id");
            $section = TodoistSection::create([
                'location_reference_id' => $taskLocation->id,
                'project_id' => $project->id,
                'rank' => $rank,
                'external_id' => $id,
                'name' => $name
            ]);
        } catch (Throwable $exception) {
            Log::warning("TodoistSectionCreateAction failed with exception {$exception->getMessage()}");
            return null;
        }

        return $section;
    }
}
