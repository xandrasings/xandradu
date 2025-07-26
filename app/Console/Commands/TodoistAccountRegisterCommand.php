<?php

namespace App\Console\Commands;

use App\Actions\PersonSelectAction;
use App\Modules\Todoist\Actions\TodoistAccountCreateAction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TodoistAccountRegisterCommand extends Command
{
    protected $signature = 'todoist:account-register {firstName} {lastName} {apiToken}';

    protected $description = 'Register a Todoist account for a person';

    protected PersonSelectAction $personSelectAction;

    protected TodoistAccountCreateAction $accountCreateAction;

    public function __construct()
    {
        parent::__construct();
        $this->personSelectAction = app(PersonSelectAction::class);
        $this->accountCreateAction = app(TodoistAccountCreateAction::class);
    }

    public function handle()
    {
        $firstName = $this->argument('firstName');
        $lastName = $this->argument('lastName');
        $token = $this->argument('apiToken');

        print_r("CONSOLE COMMAND INITIATED: $this->signature $firstName $lastName\n");
        Log::notice("CONSOLE COMMAND INITIATED: $this->signature $firstName $lastName");

        $person = $this->personSelectAction->handle($firstName, $lastName);
        if (is_null($person)) {
            Log::error("TodoistAccountCreateAction failed due to failure of PersonSelectAction.");
            print_r("CONSOLE COMMAND ABORTED: $this->signature $firstName $lastName\n");
            Log::notice("CONSOLE COMMAND ABORTED: $this->signature $firstName $lastName");
            return;
        }

        $this->accountCreateAction->handle($person, $token);

        print_r("CONSOLE COMMAND COMPLETED: $this->signature $firstName $lastName\n");
        Log::notice("CONSOLE COMMAND COMPLETED: $this->signature $firstName $lastName");
    }
}
