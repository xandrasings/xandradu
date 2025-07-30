<?php

namespace App\Console\Commands;

use App\Modules\Band\Services\BandService;
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

    public function handle()
    {
        $name = $this->argument('name');

        print_r("CONSOLE COMMAND INITIATED: $this->signature $name\n");
        Log::notice("CONSOLE COMMAND INITIATED: $this->signature $name");

        if ($this->service->bandExists($name)) {
            print_r("BandRegisterCommand failed due to band already existing.");
            Log::error("BandRegisterCommand failed due to band already existing.");
            print_r("CONSOLE COMMAND ABORTED: $this->signature $name\n");
            Log::notice("CONSOLE COMMAND ABORTED: $this->signature $name");
            return;
        }

        $this->service->createBand($name);

        print_r("CONSOLE COMMAND COMPLETED: $this->signature $name\n");
        Log::notice("CONSOLE COMMAND COMPLETED: $this->signature $name");
    }
}
