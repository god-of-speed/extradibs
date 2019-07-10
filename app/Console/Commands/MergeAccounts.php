<?php

namespace App\Console\Commands;

use App\MergeAccount;
use Illuminate\Console\Command;
use App\Http\Services\AccountService;

class MergeAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MergeAccounts:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This cron job is used to merge accounts every minute';

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
        //function to handle
        //get current 
        $current = MergeAccount::find(1);
        if($current->number == 0) {
            $accountService->mergeByAdmin();
        }
        elseif($current->number == 1) {
            $accountService->mergeByNewUser();
        }
        elseif($current->number == 2) {
            $accountService->mergeByPotential();
        }
        elseif($current->number == 3) {
            $accountService->mergeByAwaiting();
        }
    }
}
