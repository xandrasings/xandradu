<?php

namespace App\Modules\Todoist\Services;

use App\Modules\Core\Models\Person;
use App\Modules\Todoist\Actions\TodoistAccountCreateAction;
use App\Modules\Todoist\Actions\TodoistAccountSyncAllAction;
use App\Modules\Todoist\Actions\TodoistSectionRealizeAction;
use App\Modules\Todoist\Models\TodoistAccount;
use App\Modules\Todoist\Models\TodoistSection;

class TodoistService
{
    protected TodoistAccountCreateAction $accountCreateAction;

    protected TodoistAccountSyncAllAction $accountSyncAllAction;

    protected TodoistSectionRealizeAction $sectionRealizeAction;

    public function __construct()
    {
        $this->accountCreateAction = app(TodoistAccountCreateAction::class);
        $this->accountSyncAllAction = app(TodoistAccountSyncAllAction::class);
        $this->sectionRealizeAction = app(TodoistSectionRealizeAction::class);
    }

    public function createAccount(Person $person, string $token): ?TodoistAccount
    {
        return $this->accountCreateAction->handle($person, $token);
    }

    public function syncAccounts(): bool
    {
        return $this->accountSyncAllAction->handle();
    }

    public function createSection(TodoistAccount $account, TodoistSection $section): ?TodoistSection
    {
        return $this->sectionRealizeAction->handle($account, $section);
    }
}
