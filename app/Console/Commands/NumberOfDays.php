<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Services\AccountService;

class NumberOfDays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'NumberOfDays:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increase the number of days left for an account';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(AccountService $accountService)
    {
        //
        $accountService->increaseNumberOfDays();
    }
}
