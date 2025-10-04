<?php

namespace App\Console\Commands;

use App\Modules\Band\Services\BandService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class BandRegisterCommand extends Command
{
    protected $signature = 'app:band-register {name}';

    protected $description = 'Register a band record if no such record exists';

    protected BandService $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = app(BandService::class);

    }

    public function handle(): void
    {
        $name = $this->argument('name');

        print_r("CONSOLE COMMAND INITIATED: $this->signature $name\n");
        Log::notice("CONSOLE COMMAND INITIATED: $this->signature $name");

        try {
            $this->service->instantiateBand($name);
        } catch (Exception $exception) {
            Log::error("BandRegisterCommand failed due to a thrown exception.", ['trace' => $exception->getTrace()]);
            print_r("CONSOLE COMMAND ABORTED: $this->signature $name\n");
            Log::notice("CONSOLE COMMAND ABORTED: $this->signature $name");
            return;
        }

        print_r("CONSOLE COMMAND COMPLETED: $this->signature $name\n");
        Log::notice("CONSOLE COMMAND COMPLETED: $this->signature $name");
    }
}
