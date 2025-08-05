<?php

namespace App\Modules\Todoist\Actions;

use App\Modules\Core\Models\EmailAddress;
use App\Modules\Todoist\Models\TodoistUser;
use Illuminate\Support\Facades\Log;

class TodoistUserGetAction
{
    protected TodoistUserInstantiateAction $userInstantiateAction;

    public function __construct()
    {
        $this->userInstantiateAction = app(TodoistUserInstantiateAction::class);
    }

    public function handle(string $id, EmailAddress $emailAddress, string $name): ?TodoistUser
    {
        $users = TodoistUser::where([
            'external_id' => $id
        ])->get();

        if (count($users) > 1) {
            Log::warning("TodoistUserGetAction failed, found too many TodoistUser records matching external id $id.");
            return null;
        }

        if ($users->isEmpty()) {
            return $this->userInstantiateAction->handle($id, $emailAddress, $name);
        }

        return $users->first();
    }
}
