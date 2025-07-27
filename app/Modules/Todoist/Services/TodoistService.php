<?php

namespace App\Modules\Todoist\Services;

use App\Models\Person;
use App\Models\TodoistAccount;
use App\Models\TodoistSection;
use App\Modules\Todoist\Actions\TodoistAccountCreateAction;
use App\Modules\Todoist\Actions\TodoistAccountsSyncAction;
use App\Modules\Todoist\Actions\TodoistProjectSelectAction;
use App\Modules\Todoist\Actions\TodoistTaskLocationCreateAction;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistService
{

    protected TodoistAccountCreateAction $accountCreateAction;

    protected TodoistAccountsSyncAction $accountsSyncAction;

    public function __construct()
    {
        $this->accountCreateAction = app(TodoistAccountCreateAction::class);
        $this->accountsSyncAction = app(TodoistAccountsSyncAction::class);
    }

    public function createAccount(Person $person, string $token): void
    {
        $this->accountCreateAction->handle($person, $token);
    }

    public function syncAccounts(): void
    {
        $this->accountsSyncAction->handle();
    }
}
