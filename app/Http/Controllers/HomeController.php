<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * display the home view
     */
    public function homePage(Request $request) {
        return view('/');
    } 
}
