<?php

namespace App\Http\Controllers;

use App\Merge;
use App\Package;
use App\UserPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * create user dashboard
     */
    public function dashboardPage(Request $request) {
        //get user
        $user = Auth::guard()->user();
        if($user) {
            //get accounts
            $accounts = UserPackage::where([
                ['userId',$user->id],
                ['closed',false]
            ])
            ->orderBy('created_at','desc')
            ->get();
            if(count($accounts) == 0) {
                return redirect('/');
            }
            //get packages
            $packages = Package::get();
           return view('pages.dashboard',['accounts'=>$accounts,'packages' => $packages]);
        }
        return redirect('/');
    }
}
