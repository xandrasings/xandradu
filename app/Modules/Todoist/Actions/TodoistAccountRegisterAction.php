<?php

namespace App\Modules\Todoist\Actions;

use App\Actions\EmailAddressGetAction;
use App\Actions\EmailAddressPersonAssociateAction;
use App\Models\Person;
use App\Models\TodoistAccount;
use App\Models\TodoistUser;
use App\Modules\Todoist\Clients\TodoistClient;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class TodoistAccountRegisterAction
{
    protected TodoistClient $todoistClient;

    protected ValidationUtility $validationUtility;

    protected EmailAddressGetAction $emailAddressGetAction;

    protected EmailAddressPersonAssociateAction $emailAddressPersonAssociateAction;

    public function __construct()
    {
        $this->todoistClient = app(TodoistClient::class);
        $this->validationUtility = app(ValidationUtility::class);
        $this->emailAddressGetAction = app(EmailAddressGetAction::class);
        $this->emailAddressPersonAssociateAction = app(EmailAddressPersonAssociateAction::class);
    }

    public function handle(string $firstName, string $lastName, string $token): bool
    {
        // TODO select action
        $people = Person::where([
            'first_name' => $firstName,
            'last_name' => $lastName,
        ])->get();

        if ($people->count() > 1) {
            Log::warning("Multiple people named $firstName $lastName exist.");
            return false;
        }

        if($people->isEmpty()) {
            Log::warning("No person named $firstName $lastName exists.");
            return false;
        }

        $person = $people->first();

        $response = $this->todoistClient->getUser($token);

        $email = data_get($response, 'email');
        $name = data_get($response, 'full_name');
        $externalId = data_get($response, 'id');

        if (! $this->validationUtility->containsNoNulls([$email, $name, $externalId])) {
            Log::error("TodoistAccountRegisterAction couldn't proceed due to a missing non-nullable variable");
            return false;
        }

        $emailAddress = $this->emailAddressGetAction->handle($email);
        if(is_null($emailAddress)) {
            Log::warning("TodoistAccountRegisterAction failed due to unsuccessful call to EmailAddressGetAction.");
            return false;
        }

        $result = $this->emailAddressPersonAssociateAction->handle($emailAddress, $person, 'todoist');
        if(! $result) {
            Log::warning("TodoistAccountRegisterAction failed due to unsuccessful call to EmailAddressPersonAssociateAction.");
            return false;
        }

        $todoistUser = $emailAddress->todoistUser;

        // TODO use my functionality
        if(is_null($todoistUser)) {
            $todoistUser = TodoistUser::create([
                'external_id' => $externalId,
                'email_address_id' => $emailAddress->id,
                'name' => $name,
            ]);
        } else {
            // TODO alert about matchiness
        }

        $todoistAccount = $todoistUser->account;

        if(is_null($todoistAccount)) {
            $todoistAccount = TodoistAccount::create([
                'user_id' => $todoistUser->id,
                'access_token' => Crypt::encryptString($token),
                'sync_token' => null,
            ]);
        } else {
            // TODO alert about matchiness
        }

        return true;
    }
}
