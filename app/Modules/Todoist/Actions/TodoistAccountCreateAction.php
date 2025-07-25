<?php

namespace App\Modules\Todoist\Actions;

use App\Actions\EmailAddressGetAction;
use App\Actions\EmailAddressPersonAssociateAction;
use App\Models\Person;
use App\Models\TodoistAccount;
use App\Modules\Todoist\Clients\TodoistClient;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistAccountCreateAction
{
    protected TodoistClient $todoistClient;

    protected ValidationUtility $validationUtility;

    protected EmailAddressGetAction $emailAddressGetAction;

    protected EmailAddressPersonAssociateAction $emailAddressPersonAssociateAction;

    protected TodoistUserGetAction $userGetAction;

    public function __construct()
    {
        $this->todoistClient = app(TodoistClient::class);
        $this->validationUtility = app(ValidationUtility::class);
        $this->emailAddressGetAction = app(EmailAddressGetAction::class);
        $this->emailAddressPersonAssociateAction = app(EmailAddressPersonAssociateAction::class);
        $this->userGetAction = app(TodoistUserGetAction::class);
    }

    public function handle(Person $person, string $token): ?TodoistAccount
    {
        $response = $this->todoistClient->getUser($token);
        if (is_null($response)) {
            Log::warning("TodoistAccountCreateAction failed due to unsuccessful client call.");
            return null;
        }

        $email = data_get($response, 'email');
        $name = data_get($response, 'full_name');
        $externalId = data_get($response, 'id');

        if (! $this->validationUtility->containsNoNulls([$email, $name, $externalId])) {
            Log::warning("TodoistAccountCreateAction failed due to a missing non-nullable variable");
            return null;
        }

        $todoistUser = $this->userGetAction->handle($externalId, $email, $name);
        if(is_null($todoistUser)) {
            Log::warning("TodoistAccountCreateAction failed due to unsuccessful call to TodoistUserGetAction.");
            return null;
        }

        $result = $this->emailAddressPersonAssociateAction->handle($todoistUser->emailAddress, $person, 'todoist');
        if(! $result) {
            Log::warning("TodoistAccountCreateAction failed due to unsuccessful call to EmailAddressPersonAssociateAction.");
            return null;
        }

        if (! is_null($todoistUser->account)) {
            Log::warning("TodoistAccountCreateAction failed due to account already existing for user {$todoistUser->emailAddress->full_value}.");
            return null;
        }

        try {
            Log::notice("TodoistAccountCreateAction creating TodoistAccount for user $todoistUser->id");
            return TodoistAccount::create([
                'user_id' => $todoistUser->id,
                'access_token' => Crypt::encryptString($token),
                'sync_token' => null,
            ]);
        } catch (Throwable $exception) {
            Log::warning("TodoistAccountCreateAction failed with exception {$exception->getMessage()}");
            return null;
        }
    }
}
