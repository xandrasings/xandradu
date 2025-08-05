<?php

namespace App\Modules\Todoist\Actions;

use App\Modules\Core\Models\EmailAddress;
use App\Modules\Todoist\Models\TodoistUser;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistUserInstantiateAction
{
    public function handle(string $id, EmailAddress $emailAddress, string $name): ?TodoistUser
    {
        try {
            Log::notice("TodoistUserInstantiateAction creating TodoistUser from external $id, EmailAddress $emailAddress->id, name $name.");
            return TodoistUser::create([
                'external_id' => $id,
                'email_address_id' => $emailAddress->id,
                'name' => $name,
            ]);
        } catch (Throwable $exception) {
            Log::warning("TodoistUserInstantiateAction failed with exception {$exception->getMessage()}.");
            return null;
        }
    }
}
