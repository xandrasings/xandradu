<?php

namespace App\Console\Commands;

use App\Modules\Core\Actions\PersonRegisterAction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PersonRegisterCommand extends Command
{
    protected $signature = 'app:person-register {firstName} {lastName}';

    protected $description = 'Register a person record if no such record exists';

    protected PersonRegisterAction $personRegisterAction;

    public function __construct()
    {
        parent::__construct();
        $this->personRegisterAction = app(PersonRegisterAction::class);
    }

    public function handle()
    {
        $firstName = $this->argument('firstName');
        $lastName = $this->argument('lastName');

        print_r("CONSOLE COMMAND INITIATED: $this->signature $firstName $lastName\n");
        Log::notice("CONSOLE COMMAND INITIATED: $this->signature $firstName $lastName");

        $this->personRegisterAction->handle($firstName, $lastName);

        print_r("CONSOLE COMMAND COMPLETED: $this->signature $firstName $lastName\n");
        Log::notice("CONSOLE COMMAND COMPLETED: $this->signature $firstName $lastName");
    }
}
