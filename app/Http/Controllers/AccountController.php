<?php

namespace App\Http\Controllers;

use App\User;
use App\Merge;
use App\Package;
use App\UserPackage;
use App\MergeAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\GeneratorService;

class AccountController extends Controller
{
    /**
     * create account
     */
    public function storeAccount(Request $request) {
        //check
        if(Auth::guard()->user()) {
            //get package
            $package = $request->query('package');
            $package = $package == null && !is_int($package) ? false : Package::find($package);
            if($package) {
                if(Auth::guard()->user()->potential) {
                    //get sum
                    $sum = Auth::guard()->user()->potential + 0.2;
                    if($sum < 100) {
                        $update = Auth::guard()->user()::update([
                            'potential' => $sum
                        ]);
                    }else{
                        $update = Auth::guard()->user()::update([
                            'potential' => 100
                        ]);
                    }
                }
                //check if user has a package similar to this
                $similarAccount = UserPackage::where([
                    ['packageId',$package->id]
                ])
                ->get();
                if(count($similarAccount) > 0) {
                    $num = count($similarAccount) + 1;
                }else{
                    $num = 1;
                }
                //create package
                $account = UserPackage::create([
                    'userId' => Auth::guard()->user()->id,
                    'packageId' => $package->id,
                    'accountName' => $package->name.' '.$num,
                    'paid' => false,
                    'merged' => false,
                    'payers' => 0,
                    'startDate' => Carbon::now(),
                    'numberOfInvestments' => 0,
                    'numberOfDays' => 0,
                    'numberOfReferrals' => 0,
                    'closed' => false,
                    'blocked' => false
                ]);
                if($account) {
                    if($request->ajax()) {
                        return response()->json($account,200);
                    }
                }
            }
            if($request->ajax()) {
                return response()->json(false);
            }
            return redirect('/');
        }
        return redirect('/');
    }




    // /**
    //  * merge for payment
    //  */
    // public function mergeForPayment(Request $request) {
    //     //check if account is eligble
    //     $accountToBePaid = $request->query('mAccount');
    //     $accountToBePaid = $accountToBePaid == null && !is_int($accountToBePaid) ? false : UserPackage::find($accountToBePaid);
    //     if($accountToBePaid->paid) {
    //         //get account mergedToPay
    //         $mergedToPay = $request->query('pAccount');
    //         $mergedToPay = $mergedToPay == null && !is_int($mergedToPay) ? false : UserPackage::find($mergedToPay);
    //         if($mergedToPay) {
    //             //create merge
    //             $merge = Merge::create([
    //                 'userPackageId' => $accountToBePaid->id,
    //                 'mergedTo' => $mergedToPay->id,
    //                 'startDate' => new Datetime('now'),
    //                 'confirmed' => false
    //             ]);
    //             //run update
    //             $userPackage = UserPackage::find($merge->userPackageId);
    //             $update = $userPackage->update([
    //                 'unMerged' => false,
    //                 'payer' => (int)$userPackage->payer + 1
    //             ]);
    //             if($merge) {
    //                 return response()->json(true,200);
    //             }
    //         }
    //         return response()->json(['Internal server error'],500);
    //     }
    //     return response()->json(['Internal server error'],500);
    // }






    /**
     * upload proof of payment
     */
    public function uploadProofOfPayment(Request $request,GeneratorService $generatorService) {
        //check
        if(Auth::guard()->user()) {
            $request->validate([
                'image' => 'required|image|file|max:6000|mimetypes:image/png,image/jpeg,image/jpg'
            ]);
            if($request->image) {
                $filename = $generatorService->generateRandomString();
                //create directory
                $dir = public_path()."/images/proof_of_payment";
                if(!file_exists($dir)) {
                    mkdir($dir);
                }
                //save image
                $filename = $filename.'.'.$request->image->guessExtension();

                $request->image->move($dir,$filename);
                //get merge
                $merge = $request->query('merge');
                $merge = $merge == null && !is_int($merge) ? false : Merge::find($merge);
                if($merge) {
                    //update
                    $update = $merge->update([
                        'proofOfPayment' => "images/proof_of_payment/".$filename
                    ]);
                    //get account
                    $account = $request->query('account');
                    $account = $account == null && !is_int($account) ? false : UserPackage::find($account);
                    if($account) {
                        return redirect('/account?account='.$account->id);
                    }
                    return redirect('/dashboard');
                }
                //get account
                $account = $request->query('account');
                $account = $account == null && !is_int($account) ? false : UserPackage::find($account);
                if($account) {
                    return redirect('/account?account='.$account->id);
                }
                return redirect('/dashboard');
            }
        }
        return redirect('/login');
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
            //initialize
            $totalMerges = null;
            $mergedTo = null;
            if($account) {
                    $merges = Merge::where([
                        ['userPackageId',$account->id],
                        ['confirmed',false]
                    ])
                    ->orderBy('created_at','desc')
                    ->get();
                    //get account details
                    //total merge
                    $totalMerges = [];
                    foreach($merges as $merge) {
                        //get account details
                        $accountDetails = UserPackage::find($merge->mergedTo);
                        //get user details
                        $userDetails = User::find($accountDetails->userId);
                        //make a reformed array
                        $totalMerges[] = [
                            'merge' => $merge,
                            'accountDetails' => $accountDetails,
                            'userDetails' => $userDetails
                        ];
                    }
               
                    $mergedTo = Merge::where([
                        ['mergedTo',$account->id],
                        ['confirmed',false]
                    ])
                    ->orderBy('created_at','desc')
                    ->first();
                    if($mergedTo) {
                        //get user details
                        $mergedToAccount = UserPackage::find($mergedTo->userPackageId);
                        //get mergedToAccount user
                        $mergedToAccountUser = User::find($mergedToAccount->userId);
                        //reform mergedTo
                        $mergedTo = [
                            'mergeDetails' => $mergedTo,
                            'accountDetails' => $mergedToAccount,
                            'userDetails' => $mergedToAccountUser
                        ];
                    }
                //get details
                $totalMerges = $totalMerges == null ? false : $totalMerges;
                $mergedTo = $mergedTo == null ? false : $mergedTo;
                return view('pages.account',['account'=>$account,'totalMerges'=>$totalMerges,'mergedTo'=>$mergedTo]);
            }
            $errors = new Messagebag;
            $errors = $errors->add('errors','Not existing!');
            if($request->ajax()) {
                return response()->json([
                    'truthy'=>false,
                    'errors'=>$errors
                ]);
            }
            return redirect('/');;
        }
        $errors = new Messagebag;
        $errors = $errors->add('errors','Unauthenticated!');
        if($request->ajax()) {
            return response()->json([
                'truthy'=>false,
                'errors'=>$errors
            ]);
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
        $merge = $merge == null && !is_int($merge) ? false : Merge::find($merge);
        if($merge) {
            if($merge->account()->first()->user()->first()->id == Auth::guard()->id()) {
                $update = $merge->update([
                    'confirmed' => true
                ]);
    
                $userPackage = UserPackage::find($merge->mergedTo);
                $alsoUpdate = $userPackage->update([
                    'paid' => true,
                    'numberOfDays' => 0
                ]);

                $merge->delete();
        
                if($update && $alsoUpdate) {
                    return response()->json([
                        'truthy'=>true
                    ]); 
                }
            }
            return response()->json([
                'truthy'=>false,
                'errors'=>'Forbidden'
            ]);               
        }
            return response()->json([
                'truthy'=>false,
                'errors'=>'Not existing!'
            ]); 
        }
        return redirect('/login');
    }





    // /**
    //  * after confirmation
    //  */
    // public function afterConfirmation($merge) {
    //     $merge->destroy();
    //     return true;
    // }




    /**
     * re-invest the same package in an account
     */
    public function reInvest(Request $request) {
        if(Auth::guard()->user()) {
            //get account
            $account = $request->query('account');
            $account = $account == null & !is_int($account) ? false : UserPackage::find($account);
            if($account) {
                if(Auth::guard()->user()->potential) {
                    //get sum
                    $sum = Auth::guard()->user()->potential + 0.6;
                    if($sum < 100) {
                        $update = Auth::guard()->user()::update([
                            'potential' => $sum
                        ]);
                    }else{
                        $update = Auth::guard()->user()::update([
                            'potential' => 100
                        ]);
                    }
                }
                //update account
                $update = $account->update([
                    'paid' => false,
                    'merged' => false,
                    'unMerged' => true,
                    'numberOfDays' => 0,
                    'payers' => 0,
                    'numberOfInvestments' => (int)$account->numberOfInvestments + 1 
                ]);
                if($update) {
                    if($request->ajax()) {
                        return response()->json([
                            'truthy'=>true
                        ]);
                    }
                    return redirect('/dashboard');
                }else{
                    $errors = new Messagebag;
                    $errors = $errors->add('Internal server error');
                    if($request->ajax()) {
                        return response()->json([
                            'truthy'=>false,
                            'errors'=>$errors
                        ]);
                    }
                    return redirect('/dashboard');
                }
            }
            $errors = new Messagebag;
            $errors = $errors->add('Not existing!');
            if($request->ajax()) {
                return response()->json([
                    'truthy'=>false,
                    'errors'=>$errors
                ]);
            }
            return redirect('/dashboard');
        }
        $errors = new Messagebag;
        $errors = $errors->add('Unauthenticated!');
        if($request->ajax()) {
            return response()->json([
                'truthy'=>false,
                'errors'=>$errors
            ]);
        }
        return redirect('/');
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
                    if($update) {
                        if($request->ajax()) {
                            return response()->json([
                                'truthy'=>true
                            ]);
                        }
                        return redirect('/dashboard');
                    }else{
                        $errors = new Messagebag;
                        $errors = $errors->add('Internal server error');
                        if($request->ajax()) {
                            return response()->json([
                                'truthy'=>false,
                                'errors'=>$errors
                            ]);
                        }
                        return redirect('/dashboard');
                    }
                }
                $errors = new Messagebag;
                $errors = $errors->add('Forbidden!');
                if($request->ajax()) {
                    return response()->json([
                        'truthy'=>false,
                        'errors'=>$errors
                    ]);
                }
                return redirect('/dashboard');
            }
            $errors = new Messagebag;
            $errors = $errors->add('Not existing!');
            if($request->ajax()) {
                return response()->json([
                    'truthy'=>false,
                    'errors'=>$errors
                ]);
            }
            return redirect('/dashboard');
        }
        $errors = new Messagebag;
        $errors = $errors->add('Unauthenticated!');
        if($request->ajax()) {
            return response()->json([
                'truthy'=>false,
                'errors'=>$errors
            ]);
        }
        return redirect('/');
    }
}
