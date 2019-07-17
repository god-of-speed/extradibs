<?php

namespace App\Http\Controllers;

use App\Package;
use App\UserPackage;
use App\Merge;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use App\Http\Services\GeneratorService;

class AdminController extends Controller
{


    /**
     * create package
     */
    public function package(Request $request) {
        //check
        if(Auth::guard()->id()) {
            if(Auth::guard()->user()->role == 'admin') {
                return view('pages.add_package');
            }
            $errors = new Messagebag;
            $errors = $errors->add('errors','Forbidden');
            return redirect('/dashboard'); 
        }
        return redirect('/login');
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
                $filename = $generatorService->generateRandomString().'.'.$data['image']->guessExtension();
                //get directory
                $dir = public_path().'/images/packages';
                if(file_exists($dir)) {
                    mkdir($dir);
                }
                //move file
                $data['image']->move($dir,$filename);
                //save image
                //create package
                $package = Package::create([
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'image' => '/images/packages/'.$filename
                ]);
                if($package) {
                    return redirect('/admin_package');
                } 
                return response()->json("Internal server error",500);
            }
            return redirect('/dashboard');
        }
        return redirect('/login');
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
                $account = (int)$request->query('account');
                $account = $account == null && !is_int($account) ? false : UserPackage::find($account);
                if($account) {
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
                    return redirect('/admin_panel?filter=fresh');
                }
                return redirect('/admin_panel?filter=fresh');
            }
            return redirect('/dashboard');
        }
        return redirect('/login');
    }






    /**
     * unblock user
     */
    public function unBlockAccount(Request $request) {
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
                    return redirect('/admin_panel?filter=fresh');
                }
                return redirect('/admin_panel?filter=fresh');
            }
            return redirect('/dashboard');
        }
        return redirect('/login');
    }
    




       /**
        * get users by filtering
        */
        public function adminTable(Request $request) {
            //check user
            $user = Auth::guard()->user();
            if($user) {
                if($user->role == 'admin') {
                    //get filter
                    $filter = $request->query('filter');
                    if($filter == 'fresh') {
                        //get page
                        $pages = UserPackage::where([
                            ['closed',false],
                            ['paid',false],
                            ['merged',false],
                            ['unMerged',true],
                            ['payers',0]
                        ])
                        ->orderBy('updated_at','asc')
                        ->get();
                        $pages = count($pages) < 50 ? 1 : ceil(count($pages)/50);
                        $p = $request->query('p');
                        if($p != null && is_int($p)) {
                            $p = $p;
                        }else{
                            $p =1;  
                        }
                        //get starting point
                        $s = $request->query('s');
                        if($s != null && is_int($s)) {
                            $s = $s;
                        }else{
                            $s = 0;
                        }
                        //get accounts that are fresh
                        $accounts = UserPackage::where([
                            ['closed',false],
                            ['paid',false],
                            ['merged',false],
                            ['unMerged',true],
                            ['payers',0]
                        ])
                        ->skip($s)
                        ->take(50)
                        ->orderBy('updated_at','asc')
                        ->get();
                        //get complete array
                        $arr = [];
                        foreach($accounts as $account) {
                            //get user info
                            $info = User::find($account->userId);
                            $package = Package::find($account->packageId);
                            $arr[] = ['user' => $info, 'account' => $account, 'package' => $package];
                        }

                        return view('pages.admin.panel',[
                            'arr' => $arr,
                            'pages'=> $pages,
                            'p'=> $p,
                            's' => $s
                        ]); 
                    }
                    elseif($filter == 'un-merged') {
                        //get page
                        $pages = UserPackage::where([
                            ['closed',false],
                            ['paid',true],
                            ['merged',true],
                            ['unMerged',true],
                            ['payers',0]
                        ])
                        ->orderBy('updated_at','asc')
                        ->get();
                        $pages = count($pages) < 50 ? 1 : ceil(count($pages)/50); 
                        $p = $request->query('p');
                        if($p != null && is_int($p)) {
                            $p = $p;
                        }else{
                            $p = 1; 
                        }
                        //get starting point
                        $s = $request->query('s');
                        if($s != null && is_int($s)) {
                            $s = $s;
                        }else{
                            $s = 0;
                        }
                        //get accounts that are fresh
                        $accounts = UserPackage::where([
                            ['closed',false],
                            ['paid',true],
                            ['merged',true],
                            ['unMerged',true],
                            ['payers',0]
                        ])
                        ->skip($s)
                        ->take(50)
                        ->orderBy('updated_at','asc')
                        ->get();

                        //get complete array
                        $arr = [];
                        foreach($accounts as $account) {
                            //get user info
                            $info = User::find($account->userId);
                            $package = Package::find($account->packageId);
                            $arr[] = ['user' => $info, 'account' => $account, 'package' => $package];
                        }

                        return view('pages.admin.panel',[
                            'arr' => $arr,
                            'pages' => $pages,
                            'p'=> $p,
                            's' => $s
                        ]);  
                    }
                    elseif($filter == 'merged') {
                        //get page
                        $pages = UserPackage::where([
                            ['closed',false],
                            ['paid',true],
                            ['merged',true],
                            ['payers','<',2]
                        ])
                        ->orderBy('updated_at','asc')
                        ->get();
                        $pages = count($pages) < 50 ? 1 : ceil(count($pages)/50);  
                        $p = $request->query('p');
                        if($p != null && is_int($p)) {
                            $p = $p;
                        }else{
                            $p = 1;
                        }
                        //get starting point
                        $s = $request->query('s');
                        if($s != null && is_int($s)) {
                            $s = $s;
                        }else{
                            $s = 0;
                        }
                        //get accounts that are fresh
                        $accounts = UserPackage::where([
                            ['closed',false],
                            ['paid',true],
                            ['merged',true],
                            ['payers','<',2]
                        ])
                        ->skip($s)
                        ->take(50)
                        ->orderBy('updated_at','asc')
                        ->get();

                        //get complete array
                        $arr = [];
                        foreach($accounts as $account) {
                            //get user info
                            $info = User::find($account->userId);
                            $package = Package::find($account->packageId);
                            $arr[] = ['user' => $info, 'account' => $account, 'package' => $package];
                        }

                        return view('pages.admin.panel',[
                            'arr' => $arr,
                            'pages' => $pages,
                            'p'=> $p,
                            's' => $s
                        ]);  
                    }
                    elseif($filter == 'success') {
                        //get page
                        $pages = UserPackage::where([
                            ['closed',false],
                            ['paid',true],
                            ['merged',true],
                            ['unMerged',false],
                            ['payers',2]
                        ])
                        ->orderBy('updated_at','asc')
                        ->get();
                        $pages = count($pages) < 50 ? 1 : ceil(count($pages)/50); 
                        $p = $request->query('p');
                        if($p != null && is_int($p)) {
                            $p = $p;
                        }else{
                            $p = 1;
                        }
                        //get starting point
                        $s = $request->query('s');
                        if($s != null && is_int($s)) {
                            $s = $s;
                        }else{
                            $s = 0;
                        }
                        //get accounts that are fresh
                        $accounts = UserPackage::where([
                            ['closed',false],
                            ['paid',true],
                            ['merged',true],
                            ['unMerged',false],
                            ['payers',2]
                        ])
                        ->skip($s)
                        ->take(50)
                        ->orderBy('updated_at','asc')
                        ->get();

                        //get complete array
                        $arr = [];
                        foreach($accounts as $account) {
                            //get user info
                            $info = User::find($account->userId);
                            $package = Package::find($account->packageId);
                            $arr[] = ['user' => $info, 'account' => $account, 'package' => $package];
                        }

                        return view('pages.admin.panel',[
                            'arr' => $arr,
                            'pages'=>$pages,
                            'p'=> $p,
                            's' => $s
                        ]);  
                    }
                    else {
                        //get page
                        $pages = UserPackage::where([
                            ['closed',false],
                        ])
                        ->orderBy('updated_date','asc')
                        ->get();
                        $pages = count($pages) < 50 ? 1 : ceil(count($pages)/50);  
                        $p = $request->query('p');
                        if($p != null && is_int($p)) {
                            $p = $p;
                        }else{
                            $p =1;
                        }
                        //get starting point
                        $s = $request->query('s');
                        if($s != null && is_int($s)) {
                            $s = $s;
                        }else{
                            $s = 0;
                        }
                        //get accounts that are fresh
                        $accounts = UserPackage::where([
                            ['closed',false],
                        ])
                        ->skip($s)
                        ->take(50)
                        ->orderBy('updated_date','asc')
                        ->get();

                        //get complete array
                        $arr = [];
                        foreach($accounts as $account) {
                            //get user info
                            $info = User::find($account->userId);
                            $arr[] = ['user' => $info, 'account' => $account];
                        }

                        return view('pages.admin.panel',[
                            'arr' => $arr,
                            'pages'=>$pages,
                            'p'=> $p,
                            's' => $s
                        ]);  
                    }
                }
                return redirect('/dashboard');
            }
            return redirect('/login');
        }




    /**
     * manual merging
     */
    public function merging(Request $request) {
        //check
        if(Auth::guard()->user()) {
            if(Auth::guard()->user()->role == 'admin') {
                //get mergedTo
                $mergedTo = (int)$request->query('mergedTo');
                $mergedTo = $mergedTo == null || !is_int($mergedTo) ? false : UserPackage::find($mergedTo);
                if($mergedTo) {
                    //store mergedTo in session
                    session(['mergedTo'=>$mergedTo->id]);
                    return redirect('/admin_panel?filter=merged');
                }
                return redirect('/admin_panel?filter=fresh');
            }
            return redirect('/dashboard');
        }
        return redirect('/login');
    }





    /**
     * merge
     */
    public function finalMerge(Request $request) {
        //check
        if(Auth::guard()->user()) {
            if(Auth::guard()->user()->role == 'admin') {
                //get merge
                $merge =  (int)$request->query('merge');
                $merge = $merge == null || !is_int($merge) ? false : UserPackage::find($merge);
                if($merge) {
                    //get mergedTo
                    $mergedTo = (int)session('mergedTo');
                    $mergedTo = $mergedTo == null || !is_int($mergedTo) ? false : UserPackage::find($mergedTo);
                    if($mergedTo) {
                        //update account
                        if($merge->userId != 1){
                            $update = $merge->update([
                                'payers' => $merge->payers + 1,
                                'unMerged' => false
                            ]);
                        }
                        if($merge->payers == 2) {
                            $merge->update([
                                'entry' => 'old'
                            ]);
                        }
                        //update merge table
                        $newMerge = Merge::create([
                            'userPackageId' => $merge->id,
                            'mergedTo' => $mergedTo->id,
                            'startDate' => Carbon::now()
                        ]);
                        //update merged accounts
                        $updateMergedAccount = $mergedTo->update([
                            'merged' => true
                        ]);
                        session()->forget('mergedTo');
                        return redirect('/admin_panel?filter=fresh'); 
                    }
                    session()->forget('mergedTo');
                    return redirect('/admin_panel?filter=fresh');
                }
            }
            return redirect('/dashboard');
        }
        return redirect('/login');
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
