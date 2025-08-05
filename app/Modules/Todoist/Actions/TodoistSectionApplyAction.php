<?php

namespace App\Modules\Todoist\Actions;

use App\Modules\Todoist\Models\TodoistSection;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;

class TodoistSectionApplyAction
{
    protected ValidationUtility $validationUtility;

    protected TodoistSectionExistsAction $sectionExistsAction;

    protected TodoistSectionSelectAction $sectionSelectAction;

    protected TodoistSectionInstantiateAction $sectionInstantiateAction;

    protected TodoistSectionUpdateAction $sectionUpdateAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->sectionExistsAction = app(TodoistSectionExistsAction::class);
        $this->sectionSelectAction = app(TodoistSectionSelectAction::class);
        $this->sectionInstantiateAction = app(TodoistSectionInstantiateAction::class);
        $this->sectionUpdateAction = app(TodoistSectionUpdateAction::class);
    }

    public function handle(array $payload): ?TodoistSection
    {
        $id = data_get($payload, 'v2_id');
        if (!$this->validationUtility->containsNoNulls([$id])) {
            Log::warning("TodoistSectionApplyAction couldn't proceed due to a missing non-nullable variable.");
            return null;
        }

        if ($this->sectionExistsAction->handle($id)) {
            $section = $this->sectionSelectAction->handle($id);
            if (!$this->validationUtility->containsNoNulls([$section])) {
                Log::warning("TodoistSectionApplyAction couldn't proceed due to a missing non-nullable variable.");
                return null;
            }

            return $this->sectionUpdateAction->handle($section, $payload);
        }

        return $this->sectionInstantiateAction->handle($payload);
    }
}
