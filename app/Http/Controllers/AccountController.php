<?php

namespace App\Http\Controllers;

use App\Merge;
use App\Package;
use App\UserPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\GeneratorService;

class AccountController extends Controller
{
    /**
     * create account
     */
    public function storeAccount(Request $request,$package,GeneratorService $generatorService) {
        //check
        if(Auth::guard()->user()) {
            //get package
            $package = $package == null && !is_int($package) ? false : Package::find($package);
            //create package
            $account = UserPackage::create([
                'userId' => Auth::guard()->user()->id,
                'package' => $package->id,
                'paid' => false,
                'merged' => false,
                'payers' => 0,
                'startDate' => new Datetime('now'),
                'numberOfInvestments' => 0,
                'ref' => $generatorService->generateReferralLink(),
                'numberOfReferrals' => 0,
                'closed' => false,
                'blocked' => false
            ]);
            if($account) {
                if(Request::ajax()) {
                    return response()->json([
                        'account' => $account
                    ],200);
                }
                return $account;
            }
        }
        return redirect('/');
    }




    /**
     * merge for payment
     */
    public function mergeForPayment(Request $request) {
        //check if account is eligble
        $accountToBePaid = $request->query('mAccount');
        $accountToBePaid = $accountToBePaid == null && !is_int($accountToBePaid) ? false : UserPackage::find($accountToBePaid);
        if($accountToBePaid->paid) {
            //get account mergedToPay
            $mergedToPay = $request->query('pAccount');
            $mergedToPay = $mergedToPay == null && !is_int($mergedToPay) ? false : UserPackage::find($mergedToPay);
            if($mergedToPay) {
                //create merge
                $merge = Merge::create([
                    'userPackageId' => $accountToBePaid->id,
                    'mergedTo' => $mergedToPay->id,
                    'startDate' => new Datetime('now'),
                    'confirmed' => false
                ]);
                //run update
                $userPackage = UserPackage::find($merge->userPackageId);
                $update = $userPackage->update([
                    'unMerged' => false,
                    'payer' => (int)$userPackage->payer + 1
                ]);
                if($merge) {
                    return response()->json(true,200);
                }
            }
            return response()->json(['Internal server error'],500);
        }
        return response()->json(['Internal server error'],500);
    }






    /**
     * upload proof of payment
     */
    public function uploadProofOfPayment(Request $request,GeneratorService $african) {
        //check
        if(Auth::guard()->user()) {
            $request->validate([
                'image' => 'required|image|file|max:3000|mimetypes:image/png,image/jpg'
            ]);
            if($request->image) {
                $filename = $generatorService->generateRandomString();
                //create directory
                $dir = public_path()."/images/proof_of_payment";
                if(!file_exists($dir)) {
                    mkdir($dir);
                }
                $request->image->move($dir,$filename.'.'.$request->image->guessExtension());
                //save image
                $filename = "/images/proof_of_payment/".$filename.'.'.$request->image->guessExtension();
                //get merge
                $merge = $request->merge;
                $merge = $merge == null && !is_int($merge) ? false : Merge::find($merge);
                if($merge) {
                    //update
                    $update = $merge->update([
                        'proofOfPayment' => $filename
                    ]);
                    return response()->json([
                        'merge' => $merge
                    ],200);
                }
                return response()->json('Internal server error',500);
            }
        }
        return response()->json('Unauthenticated',403);
    }





    /**
     * get account details
     */
    public function accountPage(Request $request) {
        //check if authenticated
        if(Auth::guard()->user()) {
            //get account
            $account = $request->query('account');
            $account = $account == null && !is_int($account) ? false : UserPackage::find($account);
            if($account) {
                if($account->paid) {
                    $merges = Merge::where([
                        ['userPackageId',$account->id],
                        ['confirmed',false]
                    ])
                    ->orderBy('createdDate','desc')
                    ->get();
                }
                if($account->merged && !$account->paid) {
                    $mergedTo = Merge::where([
                        ['mergedTo',$account->id],
                        ['confirmed',false]
                    ])
                    ->orderBy('createdDate',false)
                    ->get();
                }
                //get details
                $merges = $merges == null ? false : $merges;
                $mergedTo = $mergedTo == null ? false : $mergedTo;
                return view('account',['account'=>$account,'merges'=>$merges,'mergedTo'=>$mergedTo]);
            }
            return redirect('/');
        }
        return redirect('/');
    }



    /**
     * confirm payment
     * 
     */
    public function confirmPayment(Request $request) {
        //check
        if(Auth::guard()->user()) {
            //get account
            $merge = $request->query('merge');
            $merge = $merge == null && !is_int($merge) ? false : UserPackage::find($merge);
            if($account) {
                //get merged account
                $merge = Merge::find($merge);
                if(merge) {
                    $update = $merge->update([
                        'confirmed' => true
                    ]);
                    $userPackage = UserPackage::find($merge->mergedTo);
                    $alsoUpdate = $userPackage->update([
                        'paid' => true
                    ]);
                    $updateAccount = $account->update([
                        'payers' => (int)$account->payers - 1
                    ]);

                    $account = $this->afterConfirmation($merge,$account);
        
                    if($update && $alsoUpdate) {
                        return response()->json([
                            'account' => $account
                        ],200);
                    }
                }
                $errors = new Messagebag;
                $errors = $errors->add('Not existing!');
                return back()->with($errors);
            }
            return redirect('/');
        }
        return redirect('/');
    }





    /**
     * after confirmation
     */
    public function afterConfirmation($merge) {
        //get merge
        $merge = Merge::find($merge);
        //get userPackage
        $account = UserPackage::find($merge->userPackageId);
        $merge->destroy();
        return $account;
    }




    /**
     * re-invest the same package in an account
     */
    public function reInvest($account) {
        //update account
        $update = $account->update([
            'paid' => false,
            'merged' => false,
            'payers' => 0,
            'numberOfInvestments' => (int)$account->numberOfInvestments + 1 
        ]);
        return $account;
    }





    /**
     * close account
     */
    public function closeAccount(Request $request) {
        //check user
        if(Auth::guard()->id()) {
            //get account
            $account = $request->query('account');
            $account = $account == null && !is_int($account) ? false : UserPackage::find($account);
            if($account) {
                if(Auth::guard()->id() == $account->userId ) {
                    //update account
                    $update = $account->update([
                        'closed' => true
                    ]);
                    return response()->json(true,200);
                }
                return redirect('/');
            }
            return redirect('/');
        }
        return redirect('/');
    }
}
