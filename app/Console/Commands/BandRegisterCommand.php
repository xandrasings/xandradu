<?php

namespace App\Console\Commands;

use App\Actions\BandRegisterAction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class BandRegisterCommand extends Command
{
    protected $signature = 'app:band-register {name}';

    protected $description = 'Register a band record if no such record exists';

    protected  BandRegisterAction $action;

    public function __construct()
    {
        parent::__construct();
        $this->action = app(BandRegisterAction::class);
    }

    public function handle()
    {
        $name = $this->argument('name');

        print_r("CONSOLE COMMAND INITIATED: $this->signature $name\n");
        Log::notice("CONSOLE COMMAND INITIATED: $this->signature $name");

        $this->action->handle($name);

        print_r("CONSOLE COMMAND COMPLETED: $this->signature $name\n");
        Log::notice("CONSOLE COMMAND COMPLETED: $this->signature $name");
    }
}
