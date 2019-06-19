<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * display the home view
     */
    public function index(Request $request) {
        //get packages
        $packages = Package::get();
        return view('pages.home',['packages'=>$packages]);
    } 
}
