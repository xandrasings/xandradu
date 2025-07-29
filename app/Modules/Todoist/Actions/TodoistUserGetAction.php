<?php

namespace App\Modules\Todoist\Actions;

use App\Actions\EmailAddressGetAction;
use App\Models\TodoistUser;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistUserGetAction
{
    protected EmailAddressGetAction $emailAddressGetAction;

    public function __construct()
    {
        $this->emailAddressGetAction = app(EmailAddressGetAction::class);
    }

    public function handle(string $id, string $email, string $name): ?TodoistUser
    {
        $emailAddress = $this->emailAddressGetAction->handle($email);

        if (is_null($emailAddress)) {
            Log::warning("TodoistUserGetAction failed, due to unsuccessful result from EmailAddressGetAction.");
            return null;
        }

        $users = TodoistUser::where(['external_id' => $id])->get();

        if (count($users) > 1) {
            Log::warning("TodoistUserGetAction failed, found too many TodoistUser records matching id $id.");
            return null;
        }

        if ($users->isEmpty()) {
            try {
                Log::notice("TodoistUserGetAction creating TodoistUser $id $email $name");
                return TodoistUser::create([
                    'external_id' => $id,
                    'email_address_id' => $emailAddress->id,
                    'name' => $name,
                ]);
            } catch (Throwable $exception) {
                Log::warning("TodoistUserGetAction failed with exception {$exception->getMessage()}");
                return null;
            }
        } else {
            $user = $users->first();

            if ($user->emailAddress->id !== $emailAddress->id) {
                Log::warning("TodoistUserGetAction found TodoistUser EmailAddress id {$user->email->id} does not match value $emailAddress->id");
            }

            if ($user->name !== $name) {
                Log::warning("TodoistUserGetAction found TodoistUser name id $user->name does not match value $name");
            }

            return $user;
        }
    }
}
