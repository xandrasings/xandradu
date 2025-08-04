<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistSection;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;

class TodoistSectionApplyAction
{
    protected ValidationUtility $validationUtility;

    protected TodoistSectionExistsAction $sectionExistsAction;

    protected TodoistSectionSelectAction $sectionSelectAction;

    protected TodoistSectionInitializeAction $sectionInitializeAction;

    protected TodoistSectionUpdateAction $sectionUpdateAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->sectionExistsAction = app(TodoistSectionExistsAction::class);
        $this->sectionSelectAction = app(TodoistSectionSelectAction::class);
        $this->sectionInitializeAction = app(TodoistSectionInitializeAction::class);
        $this->sectionUpdateAction = app(TodoistSectionUpdateAction::class);
    }

    public function handle(array $payload): ?TodoistSection
    {
        $id = data_get($payload, 'v2_id');
        if (! $this->validationUtility->containsNoNulls([$id])) {
            Log::warning("TodoistSectionApplyAction couldn't proceed due to a missing non-nullable variable.");
            return null;
        }

        if ($this->sectionExistsAction->handle($id)) {
            $section = $this->sectionSelectAction->handle($id);
            if (! $this->validationUtility->containsNoNulls([$section])) {
                Log::warning("TodoistSectionApplyAction couldn't proceed due to a missing non-nullable variable.");
                return null;
            }

            return $this->sectionUpdateAction->handle($section, $payload);
        }

        return $this->sectionInitializeAction->handle($payload);
    }
}
