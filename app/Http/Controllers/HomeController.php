<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * display the home view
     */
    public function index(Request $request) {
        if(Auth::guard()->user()) {
            return redirect('/dashboard');
        }
        //get packages
        $packages = Package::get();
        
        return view('pages.home',['packages'=>$packages]);
    } 



    /**
     * register user to a package
     */
    public function packagePage(Request $request) {
        //get package
        $package = $request->query('package');
        $package = $package == null && !is_int($package) ? false : Package::find($package);
        if($package) {
          //set action url
          $action = '/register?package='.$package->id;
          return view('pages.register',['package'=>$package,'action'=> $action]);
        }
        return redirect('/');
    }



    /**
     * show terms and condition
     */
    public function termsPage() {
        return view('pages.terms');
    }
}
