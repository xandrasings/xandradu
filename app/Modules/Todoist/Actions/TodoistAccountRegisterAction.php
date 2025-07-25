<?php

namespace App\Modules\Todoist\Actions;

use App\Actions\EmailAddressGetAction;
use App\Models\Person;
use App\Models\TodoistAccount;
use App\Models\TodoistUser;
use App\Modules\Todoist\Clients\TodoistClient;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class TodoistAccountRegisterAction
{
    protected TodoistClient $todoistClient;

    protected EmailAddressGetAction $emailAddressGetAction;

    public function __construct()
    {
        $this->todoistClient = app(TodoistClient::class);
        $this->emailAddressGetAction = app(EmailAddressGetAction::class);
    }

    public function handle(string $firstName, string $lastName, string $token): void
    {
        $people = Person::where([
            'first_name' => $firstName,
            'last_name' => $lastName,
        ])->get();

        if ($people->count() > 1) {
            Log::warning("Multiple people named $firstName $lastName exist.");
            return;
        }

        if($people->isEmpty()) {
            Log::warning("No person named $firstName $lastName exists.");
            return;
        }

        $person = $people->first();

        $response = $this->todoistClient->getUser($token);

        $email = data_get($response, 'email');
        $name = data_get($response, 'full_name');
        $externalId = data_get($response, 'id');

        if (is_null($email)) {
            Log::warning("Todoist did not provide an email address for the user.");
            return;
        }

        if (is_null($name)) {
            Log::warning("Todoist did not provide a name for the user.");
            return;
        }

        if (is_null($externalId)) {
            Log::warning("Todoist did not provide an external id for the user.");
            return;
        }

        $emailAddress = $this->emailAddressGetAction->handle($email);

        $todoistEmailAddresses = $person->emailAddresses()->wherePivot('label', 'todoist')->get();

        if ($todoistEmailAddresses->count() > 1) {
            Log::warning("Person $person has multiple email addresses labeled todoist");
            return;
        }

        if ($todoistEmailAddresses->count() === 1) {
            if ($todoistEmailAddresses->first()->id !== $emailAddress->id) {
                Log::warning("Person $person has a pre-existing todoist email address that does not match this one");
                return;
            }
        } else {
            $person->emailAddresses()->save($emailAddress, array('label' => 'todoist'));
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

    }
}
