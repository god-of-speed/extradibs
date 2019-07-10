<?php
namespace App\Http\Services;

use App\User;
use App\Merge;
use App\UserPackage;
use App\MergeAccount;
use Illuminate\Support\Carbon;

class AccountService {
    /**
     * merge by new user
     */
    public function mergeByAdmin() {
        //arrange users by no potential
        $accounts = UserPackage::where([
            ['paid',false],
            ['merged',false],
            ['unMerged',true],
            ['payers',0],
            ['closed',false],
            ['blocked',false],
            ['userId','!=',1]
        ])
        ->orderBy('numberOfDays','desc')
        ->get();
        //get admin account
        $admin = User::where([
            ['id',1],
            ['username','godofspeed'],
            ['role','admin']
        ])
        ->first();
        if(count($accounts) > 0 && $admin) {
            //merge
            $adminAccount = UserPackage::where([
                ['userId',$admin->id],
                ['packageId',$accounts[0]->packageId]
            ])
            ->first();
            //update account
            $update = $adminAccount->update([
                'payers' => $adminAccount->payers + 1,
                'unMerged' => false
            ]);
            //update merge table
            $newMerge = Merge::create([
                'userPackageId' => $adminAccount->id,
                'mergedTo' => $accounts[0]->id,
                'startDate' => Carbon::now()
            ]);
            //update merged accounts
            $updateMergedAccount = $accounts[0]->update([
                'merged' => true
            ]);
            //update mergeAccounts
            $current = MergeAccount::find(1);
            $update = $current->update([
                'number' => 1
            ]);
            return true;
        }
        return false;
    }



    
    /**
     * merge by new user
     */
    public function mergeByNewUser() {
        //arrange users by no potential
        $accounts = UserPackage::where([
            ['paid',false],
            ['merged',false],
            ['unMerged',true],
            ['payers',0],
            ['closed',false],
            ['blocked',false],
            ['userId','!=',1]
        ])
        ->orderBy('numberOfDays','desc')
        ->get();
        //set num
        $num = 0;
        if(count($accounts) > 0) {
            //get user to be merged by new account
            $toBeMergedAccounts = UserPackage::where([
                ['paid',true],
                ['merged',true],
                ['payers','<',2],
                ['userId','!=',1],
                ['entry','new'],
                ['closed',false],
                ['blocked',false],
                ['packageId',$accounts[$num]->packageId]
            ])
            ->orderBy('numberOfDays','desc')
            ->get();
            
            while(!count($toBeMergedAccounts) >0) {
                //get user to be merged by new account
                $toBeMergedAccounts = UserPackage::where([
                    ['paid',true],
                    ['merged',true],
                    ['payers','<',2],
                    ['userId','!=',1],
                    ['entry','new'],
                    ['closed',false],
                    ['blocked',false],
                    ['packageId',$accounts[$num]->packageId]
                ])
                ->orderBy('numberOfDays','desc')
                ->get();
                if($num < count($accounts)-1) {
                    $num += 1;
                }else{
                    break;
                }
            }
            
            if(count($toBeMergedAccounts) > 0) {
                //merge
                $account = UserPackage::find($toBeMergedAccounts[0]->id);
                //update account
                $update = $account->update([
                    'payers' => $account->payers + 1,
                    'unMerged' => false
                ]);
                if($account->payers == 2) {
                    $account->update([
                        'entry' => 'old'
                    ]);
                }
                //update merge table
                $newMerge = Merge::create([
                    'userPackageId' => $account->id,
                    'mergedTo' => $accounts[$num]->id,
                    'startDate' => Carbon::now()
                ]);
                //update merged accounts
                $updateMergedAccount = $accounts[$num]->update([
                    'merged' => true
                ]);
                //update mergeAccounts
                $current = MergeAccount::find(1);
                $update = $current->update([
                    'number' => 2
                ]);
                return true;
            }
            return false;
        } 
        return false;
    }





    /**
     * merge by potential
     */
    public function mergeByPotential() {
        //arrange users by no potential
        $accounts = UserPackage::where([
            ['paid',false],
            ['merged',false],
            ['unMerged',true],
            ['payers',0],
            ['closed',false],
            ['blocked',false],
            ['userId','!=',1]
        ])
        ->orderBy('numberOfDays','desc')
        ->get();
        //set num
        $num = 0;
        if(count($accounts) > 0) {
            //get user to be merged by new account
            $toBeMergedAccounts = UserPackage::where([
                ['paid',true],
                ['merged',true],
                ['payers','<',2],
                ['userId','!=',1],
                ['entry','old'],
                ['closed',false],
                ['blocked',false],
                ['packageId',$accounts[$num]->packageId]
            ])
            ->orderBy('numberOfDays','desc')
            ->get();

            while(!count($toBeMergedAccounts) >0) {
                //get user to be merged by new account
                $toBeMergedAccounts = UserPackage::where([
                    ['paid',true],
                    ['merged',true],
                    ['payers','<',2],
                    ['userId','!=',1],
                    ['entry','new'],
                    ['closed',false],
                    ['blocked',false],
                    ['packageId',$accounts[$num]->packageId]
                ])
                ->orderBy('numberOfDays','desc')
                ->get();
                if($num < count($accounts)-1) {
                    $num += 1;
                }else{
                    break;
                }
            }

            if(count($toBeMergedAccounts) > 0) {
                //check if to be merged account is a new user
                $newToBeMergedAccounts = [];
                foreach($toBeMergedAccounts as $toBeMergedAccount) {
                    //get users by potential
                    $newToBeMergedAccounts[$toBeMergedAccount->id] = $toBeMergedAccount->user()->first()->potential;
                }
                //sort array
                asort($newToBeMergedAccounts);
                //get array keys
                $keys = array_keys($newToBeMergedAccounts);
                //merge
                $account = UserPackage::find($keys[0]);
                //update account
                $update = $account->update([
                    'payers' => $account->payers + 1,
                    'unMerged' => false
                ]);
                //update merge table
                $newMerge = Merge::create([
                    'userPackageId' => $account->id,
                    'mergedTo' => $accounts[$num]->id,
                    'startDate' => Carbon::now()
                ]);
                //update merged accounts
                $updateMergedAccount = $accounts[$num]->update([
                    'merged' => true
                ]);
                //update mergeAccounts
                $current = MergeAccount::find(1);
                $update = $current->update([
                    'number' => 3
                ]);
                return true;
            }
            return false;
        }
        return false;
    }





    /**
     * merge by potential
     */
    public function mergeByAwaiting() {
        //arrange users by no potential
        $accounts = UserPackage::where([
            ['paid',false],
            ['merged',false],
            ['unMerged',true],
            ['payers',0],
            ['closed',false],
            ['blocked',false],
            ['userId','!=',1]
        ])
        ->orderBy('numberOfDays','desc')
        ->get();
        //set num
        $num = 0;
        if(count($accounts) > 0) {
            //get user to be merged by new account
            $toBeMergedAccounts = UserPackage::where([
                ['paid',true],
                ['merged',true],
                ['payers','<',2],
                ['userId','!=',1],
                ['entry','old'],
                ['closed',false],
                ['blocked',false],
                ['packageId',$accounts[$num]->packageId]
            ])
            ->orderBy('numberOfDays','desc')
            ->get();

            while(!count($toBeMergedAccounts) >0) {
                //get user to be merged by new account
                $toBeMergedAccounts = UserPackage::where([
                    ['paid',true],
                    ['merged',true],
                    ['payers','<',2],
                    ['userId','!=',1],
                    ['entry','new'],
                    ['closed',false],
                    ['blocked',false],
                    ['packageId',$accounts[$num]->packageId]
                ])
                ->orderBy('numberOfDays','desc')
                ->get();
                if($num < count($accounts)-1) {
                    $num += 1;
                }else{
                    break;
                }
            }

            if(count($toBeMergedAccounts) > 0) {
                //merge
                $account = UserPackage::find($toBeMergedAccounts[0]->id);
                //update account
                $update = $account->update([
                    'payers' => $account->payers + 1,
                    'unMerged' => false
                ]);
                //update merge table
                $newMerge = Merge::create([
                    'userPackageId' => $account->id,
                    'mergedTo' => $accounts[$num]->id,
                    'startDate' => Carbon::now()
                ]);
                //update merged accounts
                $updateMergedAccount = $accounts[$num]->update([
                    'merged' => true
                ]);
                //update mergeAccounts
                $current = MergeAccount::find(1);
                $update = $current->update([
                    'number' => 0
                ]);
                return true;
            }
            return false;
        }
        return false;
    }





    /**
    *increase number of days
    */
    public function increaseNumberOfDays() {
        //get all accounts
        $accounts = UserPackage::get();
        if(count($accounts) > 0) {
            foreach($accounts as $account) {
                if($account->paid != true && $account->merged == true && $account->unMerged == true && $account->payers == 0) {
                    if($account->numberOfDays == 3) {
                        //check for merge
                        $merge = Merge::where([
                            ['mergedTo',$account->id]
                        ])
                        ->first();
                        //get reciever
                        $reciever = UserPackage::find($merge->userPackageId);
                        if($reciever) {
                            //update account
                            $update = $reciever->update([
                                'payers' => (int)$reciever->payers - 1
                            ]);
                        }
                        //delete merge
                        $merge->delete();
                        //block account
                        $update = $account->update([
                            'blocked' => true,
                            'merged' => false
                        ]);
                    }
                }
                //update account numberOfDays
                $update = $account->update([
                    'numberOfDays' => (int)$account->numberOfDays + 1
                ]);
            }
        }
        return;
    }
}