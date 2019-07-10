<?php

namespace App\Http\Controllers;

use App\Package;
use App\UserPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\GeneratorService;

class AdminController extends Controller
{


    /**
     * create package
     */
    public function package(Request $request) {
        // //check
        // if(Auth::guard()->id()) {
        //     if(Auth::guard()->user()->role == 'admin') {
        //         return view('pages.add_package');
        //     }
        //     $errors = new Messagebag;
        //     $errors = $errors->add('Forbidden');
        //     return back()->with($errors); 
        // }
        // return redirect('/');
        return view('pages.add_package');
    }

    /**
     * add package
     */
    public function addPackage(Request $request,GeneratorService $generatorService) {
        //check
        if(Auth::guard()->id()) {
            if(Auth::guard()->user()->role == 'admin') {
                //validate request
                $request->validate([
                    'name' => 'required|string|max:255',
                    'description' => 'required|string',
                    'price' => 'required|integer',
                    'image' => 'required|image|file'
                ]);
                //set data
                $data = $request->only('name','description','price','image');

                //get image filename
                $filename = $generatorService->generateRandomString();
                //get directory
                $dir = public_path().'/images/packages';
                if(file_exists($dir)) {
                    mkdir($dir);
                }
                //move file
                $data['image']->move($dir,$filename.'.'.$data['image']->guessExtension());
                //save image
                //create package
                $package = Package::create([
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'image' => 'images/packages/'.$filename.'.'.$data['image']->guessExtension()
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
                    //slash user's potential by half
                    $user = $account->user()->first();
                    //update user
                    $update = $user->update([
                        'potential' => $user->potential/2
                    ]);
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
     * unblock user
     */
    public function unblockUser(Request $request) {
        //check user
        if(Auth::guard()->id()) {
            if(Auth::guard()->user()->role == 'admin') {
                //get account
                $account = $request->query('account');
                $account = $account == null && !is_int($account) ? false : UserPackage::find($account);
                if($account) {
                    //update account
                    $update = $account->update([
                        'blocked' => false
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
        * get users by filtering
        */
        public function adminTable(Request $request) {
            // //check user
            // $user = Auth::guard()->user();
            // if($user) {
            //     if($user->role == 'admin') {
            //         //get filter
            //         $filter = $request->query('filter');
            //         if($filter == 'fresh') {
            //             //get page
            //             $p = $request->query('p');
            //             if($p != null && is_int($p)) {
            //                 $p = $p;
            //             }else{
            //                 $p = UserPackage::where([
            //                     ['closed',false],
            //                     ['blocked',false],
            //                     ['paid',false],
            //                     ['merged',false],
            //                     ['unMerged',true],
            //                     ['payers',0]
            //                 ])
            //                 ->orderBy('updated_date','asc')
            //                 ->get();
            //                 $p = count($p) < 50 ? 1 : ceil(count($p)/50);  
            //             }
            //             //get starting point
            //             $s = $request->query('s');
            //             if($s != null && is_int($s)) {
            //                 $s = $s;
            //             }else{
            //                 $s = 0;
            //             }
            //             //get accounts that are fresh
            //             $accounts = UserPackage::where([
            //                 ['closed',false],
            //                 ['blocked',false],
            //                 ['paid',false],
            //                 ['merged',false],
            //                 ['unMerged',true],
            //                 ['payers',0]
            //             ])
            //             ->skip($s)
            //             ->take(50)
            //             ->orderBy('updated_date','asc')
            //             ->get();
            //             //get complete array
            //             $arr = [];
            //             foreach($accounts as $account) {
            //                 //get user info
            //                 $info = User::find($account->userId);
            //                 $package = Package::find($account->packageId);
            //                 $arr[] = ['user' => $user, 'account' => $account, 'package' => $package];
            //             }

            //             return view('pages.admin.accounts',[
            //                 'arr' => $arr,
            //                 'p'=> $p,
            //                 's' => $s
            //             ]); 
            //         }
            //         elseif($filter == 'un-merged') {
            //             //get page
            //             $p = $request->query('p');
            //             if($p != null && is_int($p)) {
            //                 $p = $p;
            //             }else{
            //                 $p = UserPackage::where([
            //                     ['closed',false],
            //                     ['blocked',false],
            //                     ['paid',true],
            //                     ['merged',true],
            //                     ['unMerged',true],
            //                     ['payers',0]
            //                 ])
            //                 ->orderBy('updated_date','asc')
            //                 ->get();
            //                 $p = count($p) < 50 ? 1 : ceil(count($p)/50);  
            //             }
            //             //get starting point
            //             $s = $request->query('s');
            //             if($s != null && is_int($s)) {
            //                 $s = $s;
            //             }else{
            //                 $s = 0;
            //             }
            //             //get accounts that are fresh
            //             $accounts = UserPackage::where([
            //                 ['closed',false],
            //                 ['blocked',false],
            //                 ['paid',true],
            //                 ['merged',true],
            //                 ['unMerged',true],
            //                 ['payers',0]
            //             ])
            //             ->skip($s)
            //             ->take(50)
            //             ->orderBy('updated_date','asc')
            //             ->get();

            //             //get complete array
            //             $arr = [];
            //             foreach($accounts as $account) {
            //                 //get user info
            //                 $info = User::find($account->userId);
            //                 $package = Package::find($account->packageId);
            //                 $arr[] = ['user' => $user, 'account' => $account, 'package' => $package];
            //             }

            //             return view('pages.admin.accounts',[
            //                 'arr' => $arr,
            //                 'p'=> $p,
            //                 's' => $s
            //             ]);  
            //         }
            //         elseif($filter == 'merged') {
            //             //get page
            //             $p = $request->query('p');
            //             if($p != null && is_int($p)) {
            //                 $p = $p;
            //             }else{
            //                 $p = UserPackage::where([
            //                     ['closed',false],
            //                     ['blocked',false],
            //                     ['paid',true],
            //                     ['merged',true],
            //                     ['unMerged',false],
            //                     ['payers','<',2]
            //                 ])
            //                 ->orderBy('updated_date','asc')
            //                 ->get();
            //                 $p = count($p) < 50 ? 1 : ceil(count($p)/50);  
            //             }
            //             //get starting point
            //             $s = $request->query('s');
            //             if($s != null && is_int($s)) {
            //                 $s = $s;
            //             }else{
            //                 $s = 0;
            //             }
            //             //get accounts that are fresh
            //             $accounts = UserPackage::where([
            //                 ['closed',false],
            //                 ['blocked',false],
            //                 ['paid',true],
            //                 ['merged',true],
            //                 ['unMerged',false],
            //                 ['payers','<',2]
            //             ])
            //             ->skip($s)
            //             ->take(50)
            //             ->orderBy('updated_date','asc')
            //             ->get();

            //             //get complete array
            //             $arr = [];
            //             foreach($accounts as $account) {
            //                 //get user info
            //                 $info = User::find($account->userId);
            //                 $package = Package::find($account->packageId);
            //                 $arr[] = ['user' => $user, 'account' => $account, 'package' => $package];
            //             }

            //             return view('pages.admin.accounts',[
            //                 'arr' => $arr,
            //                 'p'=> $p,
            //                 's' => $s
            //             ]);  
            //         }
            //         elseif($filter == 'success') {
            //             //get page
            //             $p = $request->query('p');
            //             if($p != null && is_int($p)) {
            //                 $p = $p;
            //             }else{
            //                 $p = UserPackage::where([
            //                     ['closed',false],
            //                     ['blocked',false],
            //                     ['paid',true],
            //                     ['merged',true],
            //                     ['unMerged',false],
            //                     ['payers',2]
            //                 ])
            //                 ->orderBy('updated_date','asc')
            //                 ->get();
            //                 $p = count($p) < 50 ? 1 : ceil(count($p)/50);  
            //             }
            //             //get starting point
            //             $s = $request->query('s');
            //             if($s != null && is_int($s)) {
            //                 $s = $s;
            //             }else{
            //                 $s = 0;
            //             }
            //             //get accounts that are fresh
            //             $accounts = UserPackage::where([
            //                 ['closed',false],
            //                 ['blocked',false],
            //                 ['paid',true],
            //                 ['merged',true],
            //                 ['unMerged',false],
            //                 ['payers',2]
            //             ])
            //             ->skip($s)
            //             ->take(50)
            //             ->orderBy('updated_date','asc')
            //             ->get();

            //             //get complete array
            //             $arr = [];
            //             foreach($accounts as $account) {
            //                 //get user info
            //                 $info = User::find($account->userId);
            //                 $package = Package::find($account->packageId);
            //                 $arr[] = ['user' => $user, 'account' => $account, 'package' => $package];
            //             }

            //             return view('pages.admin.accounts',[
            //                 'arr' => $arr,
            //                 'p'=> $p,
            //                 's' => $s
            //             ]);  
            //         }
            //         else {
            //             //get page
            //             $p = $request->query('p');
            //             if($p != null && is_int($p)) {
            //                 $p = $p;
            //             }else{
            //                 $p = UserPackage::where([
            //                     ['closed',false],
            //                     ['blocked',false]
            //                 ])
            //                 ->orderBy('updated_date','asc')
            //                 ->get();
            //                 $p = count($p) < 50 ? 1 : ceil(count($p)/50);  
            //             }
            //             //get starting point
            //             $s = $request->query('s');
            //             if($s != null && is_int($s)) {
            //                 $s = $s;
            //             }else{
            //                 $s = 0;
            //             }
            //             //get accounts that are fresh
            //             $accounts = UserPackage::where([
            //                 ['closed',false],
            //                 ['blocked',false]
            //             ])
            //             ->skip($s)
            //             ->take(50)
            //             ->orderBy('updated_date','asc')
            //             ->get();

            //             //get complete array
            //             $arr = [];
            //             foreach($accounts as $account) {
            //                 //get user info
            //                 $info = User::find($account->userId);
            //                 $arr[] = ['user' => $user, 'account' => $account];
            //             }

            //             return view('pages.admin.accounts',[
            //                 'arr' => $arr,
            //                 'p'=> $p,
            //                 's' => $s
            //             ]);  
            //         }
            //     }
            //     return redirect('/');
            // }
            // return redirect('/');
            return view('pages.admin_table');
        }






        /**
         * get reports
         */
        public function reports(Request $request) {

        }

    // /**
    //  * list all merge
    //  */
    // public function allPayee(Request $request) {
    //     //check
    //     if(Request::ajax()) {
    //         if(Auth::guard()->user()) {
    //             if(Auth::guard()->user()->role == 'admin') {
    //                 //get p and s
    //                 $p = $request->query('p');
    //                 if($p) {
    //                     $p = $p;
    //                 }else{
    //                     $p = ceil(count(UserPackage::where([
    //                         ['paid',false],
    //                         ['merged',false]
    //                     ])
    //                     ->get()
    //                 )/30);
    //                 }
    //                 $s = $request->query('s');
    //                 if($s) {
    //                     $s = $s;
    //                 }else{
    //                     $s = 0;
    //                 }
    //                 $accounts = UserPackage::where([
    //                     ['paid',false],
    //                     ['merged',false]
    //                 ])
    //                 ->skip($s)
    //                 ->take(30)
    //                 ->orderBy('updatedDate','desc')
    //                 ->get();
    //                 return response()->json([
    //                     'accounts' => $accounts,
    //                     'p'=>$p,
    //                     's'=>$s
    //                 ],200);
    //             }
    //             return response()->json('Unauthorized',401);
    //         }
    //         return response()->json('Unauthenticated',403);
    //     }
    //     return redirect('/');
    // }





    // /*
    //  * list all unMerged
    //  */
    // public function allUnMerged(Request $request) {
    //     //check
    //     if(Request::ajax()) {
    //         if(Auth::guard()->user()) {
    //             if(Auth::guard()->user()->role == 'admin') {
    //                 //get p and s
    //                 $p = $request->query('p');
    //                 if($p) {
    //                     $p = $p;
    //                 }else{
    //                     $p = ceil(count(UserPackage::where([
    //                         ['umMerged',true]
    //                     ])
    //                     ->get()
    //                 )/30);
    //                 }
    //                 $s = $request->query('s');
    //                 if($s) {
    //                     $s = $s;
    //                 }else{
    //                     $s = 0;
    //                 }
    //                 $accounts = UserPackage::where([
    //                     ['umMerged',true]
    //                 ])
    //                 ->skip($s)
    //                 ->take(30)
    //                 ->orderBy('updatedDate','desc')
    //                 ->get();
    //                 return response()->json([
    //                     'accounts' => $accounts,
    //                     'p'=>$p,
    //                     's'=>$s
    //                 ],200);
    //             }
    //             return response()->json('Unauthorized',401);
    //         }
    //         return response()->json('Unauthenticated',403);
    //     }
    //     return redirect('/');
    // }
}
