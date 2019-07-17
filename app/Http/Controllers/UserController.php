<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\GeneratorService;

class UserController extends Controller
{
    /**
     * display user details
     * 
     */
    public function profilePage() {
        if(Auth::guard()->user()){
            return view('pages.profile');
        }
        return redirect('/login');
    }



    /**
     * show edit page
     */
    public function showEditPage() {
        if(Auth::guard()->user()) {
            return view('pages.edit_user');
        }
        return redirect('/login');
    }




    /**
     * edit details
     * 
     */
    public function edit (Request $request) {
        //check 
        $user = Auth::guard()->user();
        //validate request
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phone' => 'required|string',
            'bankName' => 'required|string|max:255',
            'accountName' => 'required|string|max:255',
            'accountNumber' => 'required|string|max:255'
        ]);
        if($user) {
            //get details
            $data = $request->only('firstName','lastName','phone','bankName','accountName','accountNumber');
            $user = $user->update([
                'firstName' => $data['firstName'],
                'lastName' => $data['lastName'],
                'phone' => $data['phone'],
                'bankName' => $data['bankName'],
                "accountName" => $data['accountName'],
                "accountNumber" => $data['accountNumber']
            ]);
            
            return redirect('/profile');
        }
        return redirect('/login');
    }





    /**
     * upload profile picture
     */
    public function uploadProfilePhoto(Request $request,GeneratorService $generatorService) {
        //check
        if(Auth::guard()->user()) {
            //validate
            $request->validate([
                "image" => 'required|image|file|max:6000|mimetypes:image/png,image/jpeg,image/jpg'
            ]);
            //get filename
            $filename = $generatorService->generateRandomString().'.'.$request->image->guessExtension();
            //create directory
            $dir = public_path().'/images/user_profile';
            if(!file_exists($dir)) {
                mkdir($dir);
            }
            //store the image
            $request->image->move($dir,$filename);
            //get user
            $user = Auth::guard()->user();
            //update
            $update = $user->update([
                'image' => '/images/user_profile/'.$filename
            ]);
            return redirect('/profile');
        }
        return redirect('/login');
    }





    /**
     * report an issue
     * 
     */
    public function report(Request $request){
        //check user
        if(Auth::guard()->user()) {
            //get report
            $report = $request->validate([
                'report' => 'required|string'
            ]);
            //insert
            $report = Report::create([
                "userId" => Auth::guard()->id(),
                "report" => $request->report
            ]);
            if($report) {
                return response()->json('Message recieved get back o ou shortly',200);
            }
            return response()->json('Internal server error',500);
        }
        return redirect('/');
    }
}
