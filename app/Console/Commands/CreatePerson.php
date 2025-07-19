<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreatePerson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'person:create {firstName} {lastName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a person record';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $firstName = $this->argument('firstName');
        $lastName = $this->argument('lastName');

        Log::notice("executing person:create for $firstName $lastName");
    }
}
