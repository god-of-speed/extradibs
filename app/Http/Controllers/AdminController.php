<?php

namespace App\Http\Controllers;

use App\Package;
use App\UserPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    /**
     * add package
     */
    public function addPackage(Request $request) {
        //check
        if(Auth::guard()->id()) {
            if(Auth::guard()->user()->role == 'admin') {
                //validate request
                $request->validate([
                    'name' => 'required|string|max:255',
                    'description' => 'required|string',
                    'price' => 'required|integer'
                ]);
                //set data
                $data = $request->only('name','description','price');
                //create package
                $package = Package::create([
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'price' => $data['price']
                ]);
                if($package) {
                    return response()->json(true,200);
                } 
                return response()->json("Internal server error",500);
            }
            return redirect('/');
        }
        return redirect('/');
    }





    /**
     * close an account
     */
    public function closeAccount(Request $request) {
        //check user
        if(Auth::guard()->id()) {
            if(Auth::guard()->user()->role == 'admin') {
                //get account
                $account = $request->query('account');
                $account = $account == null && !is_int($account) ? false : UserPackage::find($account);
                if($account) {
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





    /**
     * block an account
     */
    public function blockAccount(Request $request) {
        //check user
        if(Auth::guard()->id()) {
            if(Auth::guard()->user()->role == 'admin') {
                //get account
                $account = $request->query('account');
                $account = $account == null && !is_int($account) ? false : UserPackage::find($account);
                if($account) {
                    //update account
                    $update = $account->update([
                        'blocked' => true
                    ]);
                    return response()->json(true,200);
                }
                return redirect('/');
            }
            return redirect('/');
        }
        return redirect('/');
    }
    






    /**
     * list all merge
     */
    public function allPayee(Request $request) {
        //check
        if(Request::ajax()) {
            if(Auth::guard()->user()) {
                if(Auth::guard()->user()->role == 'admin') {
                    //get p and s
                    $p = $request->query('p');
                    if($p) {
                        $p = $p;
                    }else{
                        $p = ceil(count(UserPackage::where([
                            ['paid',false],
                            ['merged',false]
                        ])
                        ->get()
                    )/30);
                    }
                    $s = $request->query('s');
                    if($s) {
                        $s = $s;
                    }else{
                        $s = 0;
                    }
                    $accounts = UserPackage::where([
                        ['paid',false],
                        ['merged',false]
                    ])
                    ->skip($s)
                    ->take(30)
                    ->orderBy('updatedDate','desc')
                    ->get();
                    return response()->json([
                        'accounts' => $accounts,
                        'p'=>$p,
                        's'=>$s
                    ],200);
                }
                return response()->json('Unauthorized',401);
            }
            return response()->json('Unauthenticated',403);
        }
        return redirect('/');
    }





    /*
     * list all unMerged
     */
    public function allUnMerged(Request $request) {
        //check
        if(Request::ajax()) {
            if(Auth::guard()->user()) {
                if(Auth::guard()->user()->role == 'admin') {
                    //get p and s
                    $p = $request->query('p');
                    if($p) {
                        $p = $p;
                    }else{
                        $p = ceil(count(UserPackage::where([
                            ['umMerged',true]
                        ])
                        ->get()
                    )/30);
                    }
                    $s = $request->query('s');
                    if($s) {
                        $s = $s;
                    }else{
                        $s = 0;
                    }
                    $accounts = UserPackage::where([
                        ['umMerged',true]
                    ])
                    ->skip($s)
                    ->take(30)
                    ->orderBy('updatedDate','desc')
                    ->get();
                    return response()->json([
                        'accounts' => $accounts,
                        'p'=>$p,
                        's'=>$s
                    ],200);
                }
                return response()->json('Unauthorized',401);
            }
            return response()->json('Unauthenticated',403);
        }
        return redirect('/');
    }
}
