<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistSection;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;

class TodoistSectionSyncAction
{
    protected ValidationUtility $validationUtility;

    protected TodoistSectionDeleteAction $sectionDeleteAction;

    protected TodoistSectionCreateAction $sectionCreateAction;

    protected TodoistSectionUpdateAction $sectionUpdateAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->sectionDeleteAction = app(TodoistSectionDeleteAction::class);
        $this->sectionCreateAction = app(TodoistSectionCreateAction::class);
        $this->sectionUpdateAction = app(TodoistSectionUpdateAction::class);
    }

    public function handle(array $sectionPayload): ?TodoistSection
    {
        $id = data_get($sectionPayload, 'v2_id');
        $isArchived = data_get($sectionPayload, 'is_archived');
        $isDeleted = data_get($sectionPayload, 'is_deleted');

        if (! $this->validationUtility->containsNoNulls([$id, $isArchived, $isDeleted])) {
            Log::warning("TodoistSectionSyncAction couldn't proceed due to a missing non-nullable variable");
            return null;
        }

        $sections = TodoistSection::where(['external_id' => $id])->get();

        if (! $this->validationUtility->containsNoMoreThanOne($sections)) {
            Log::warning("TodoistSectionSyncAction couldn't proceed due to multiple TodoistSections matching this id.");
            return null;
        }

        if ($isArchived || $isDeleted) {
            if ($sections->isEmpty()) {
                return null;
            }

            return $this->sectionDeleteAction->handle($sections->first());
        }

        if ($sections->isEmpty()) {
            return $this->sectionCreateAction->handle($sectionPayload);
        }

        return $this->sectionUpdateAction->handle($sections->first(), $sectionPayload);
    }
}
