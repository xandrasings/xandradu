<?php

namespace App\Modules\Todoist\Services;

use App\Models\Person;
use App\Models\TodoistAccount;
use App\Models\TodoistSection;
use App\Modules\Todoist\Actions\TodoistAccountCreateAction;
use App\Modules\Todoist\Actions\TodoistAccountsSyncAction;
use App\Modules\Todoist\Actions\TodoistSectionRealizeAction;

class TodoistService
{
    protected TodoistAccountCreateAction $accountCreateAction;

    protected TodoistAccountsSyncAction $accountsSyncAction;

    protected TodoistSectionRealizeAction $sectionRealizeAction;

    public function __construct()
    {
        $this->accountCreateAction = app(TodoistAccountCreateAction::class);
        $this->accountsSyncAction = app(TodoistAccountsSyncAction::class);
        $this->sectionRealizeAction = app(TodoistSectionRealizeAction::class);
    }

    public function createAccount(Person $person, string $token): void
    {
        $this->accountCreateAction->handle($person, $token);
    }

    public function syncAccounts(): void
    {
        $this->accountsSyncAction->handle();
    }

    public function createSection(TodoistAccount $account, TodoistSection $section): void
    {
        $this->sectionRealizeAction->handle($account, $section);
    }
}
