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
        return view('pages.profile');
    }




    /**
     * insert bank's details
     * 
     */
    public function storeBankDetails (Request $request) {
        //check 
        $user = Auth::guard()->user();
        if($user) {
            //get bank details
            $user = $user->update([
                'bankName' => $request->bankName,
                "accountName" => $request->accountName,
                "accountNumber" => $request->accountNumber
            ]);
            
            return redirect('dashboard');
        }
        return redirect('/');
    }





    /**
     * upload profile picture
     */
    public function uploadProfilePhoto(Request $request,GeneratorService $generatorService) {
        //check
        if(Auth::guard()->id) {
            //validate
            $request->validate([
                "image" => 'required|image|max:3000|mimetype:image\png,image/jpg'
            ]);
            //get filename
            $filename = $generatorService->generateRandomString();
            //create directory
            $dir = public_path().'/images/user_profile';
            if(!file_exists($dir)) {
                mkdir($dir);
            }
            //store the image
            $request->image->move($dir,$filename.'.'.$request->image->guessExtension());
            //get user
            $user = Auth::guard()->user();
            //update
            $update = $user->update([
                'image' => $filename.'.'.$request->image->guessExtension()
            ]);
            if(Request::ajax()) {
                return response()->json(true,200);
            }
            return view('profile');
        }
        return redirect('/');
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
