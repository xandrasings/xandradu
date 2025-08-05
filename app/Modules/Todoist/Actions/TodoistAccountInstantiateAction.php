<?php

namespace App\Modules\Todoist\Actions;

use App\Modules\Core\Actions\EmailAddressGetAction;
use App\Modules\Core\Actions\EmailAddressPersonAssociateAction;
use App\Modules\Core\Models\Person;
use App\Modules\Todoist\Clients\TodoistClient;
use App\Modules\Todoist\Models\TodoistAccount;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistAccountInstantiateAction
{
    protected TodoistClient $client;

    protected ValidationUtility $validationUtility;

    protected EmailAddressGetAction $emailAddressGetAction;

    protected EmailAddressPersonAssociateAction $emailAddressPersonAssociateAction;

    protected TodoistUserGetAction $userGetAction;

    public function __construct()
    {
        $this->client = app(TodoistClient::class);
        $this->validationUtility = app(ValidationUtility::class);
        $this->emailAddressGetAction = app(EmailAddressGetAction::class);
        $this->emailAddressPersonAssociateAction = app(EmailAddressPersonAssociateAction::class);
        $this->userGetAction = app(TodoistUserGetAction::class);
    }

    public function handle(Person $person, string $token, array $payload): ?TodoistAccount
    {
        $email = data_get($payload, 'email');
        $name = data_get($payload, 'full_name');
        $externalId = data_get($payload, 'id');
        if (!$this->validationUtility->containsNoNulls([$email, $name, $externalId])) {
            Log::warning("TodoistAccountInstantiateAction failed due to a missing non-nullable variable");
            return null;
        }

        $emailAddress = $this->emailAddressGetAction->handle($email);
        if (!$this->validationUtility->containsNoNulls([$emailAddress])) {
            Log::warning("TodoistAccountInstantiateAction failed due to a missing non-nullable variable");
            return null;
        }

        $user = $this->userGetAction->handle($externalId, $emailAddress, $name);
        if (!$this->validationUtility->containsNoNulls([$user])) {
            Log::warning("TodoistAccountInstantiateAction failed due to a missing non-nullable variable");
            return null;
        }

        $result = $this->emailAddressPersonAssociateAction->handle($user->emailAddress, $person, 'todoist');
        if (!$result) {
            Log::warning("TodoistAccountInstantiateAction failed due to unsuccessful call to EmailAddressPersonAssociateAction.");
            return null;
        }

        if (!is_null($user->account)) {
            Log::warning("TodoistAccountInstantiateAction failed due to account already existing for user {$user->emailAddress->full_value}.");
            return null;
        }

        try {
            Log::notice("TodoistAccountInstantiateAction creating TodoistAccount for user $user->id");
            return TodoistAccount::create([
                'user_id' => $user->id,
                'access_token' => Crypt::encryptString($token),
                'sync_token' => null,
            ]);
        } catch (Throwable $exception) {
            Log::warning("TodoistAccountInstantiateAction failed with exception {$exception->getMessage()}.");
            return null;
        }
    }
}
