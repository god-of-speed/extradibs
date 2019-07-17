<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Package;
use App\UserPackage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\GeneratorService;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'phone' => ['required','string','max:12'],
            'bankName' => ['required','string','max:255'],
            'accountName' => ['required','string','max:255'],
            'accountNumber' => ['required','string','max:255'],
            'ref' => ['string','max:255']
        ]);
    }




    /**
     * register users
     */
    public function register(Request $request) {
        //get package
        $package = (int)$request->query('package');
        $package = $package == null && !is_int($package) ? false : Package::find((int)$package);
        //get data
        $data = $request->only('firstName','lastName','username','password',
        'phone','bankName','accountName','accountNumber','ref');
        //validate$
        if($package) {
            $this->validator($data);
            //create user
            $user = $this->create($data);
            //get credentials
            $credentials = ['username'=>$data['username'],'password'=>$data['password']];
            if(Auth::attempt($credentials)) {
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
                    'userId' => Auth::guard()->id(),
                    'packageId' => $package->id,
                    'accountName' => $package->name.' '.$num,
                    'paid' => false,
                    'merged' => false,
                    'payers' => 0,
                    'startDate' => Carbon::now(),
                    'numberOfInvestments' => 0,
                    'numberOfDays' => 0,
                    'numberOfReferrals' => 0,
                    'entry'=>'new',
                    'closed' => false,
                    'blocked' => false
                ]);
                if($account) {
                    return redirect('/dashboard');
                }
            }
            return redirect('/package?package='.$package->id);
        }
        return redirect('/');
    }





    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if($data['ref']) {
            //get account with ref
           $userRef = User::where([
                'ref' => $data['ref']
            ])->first();
            //get sum of user's potential
            $sum = (int)$userRef->potential + 1;
            if($sum > 100) {
                $update = $userRef->update([
                    'potential' => 100
                ]);
            }else{
                $update = $userRef->update([
                    'potential' => $sum
                ]);
            }
        }

        return User::create([
            'firstName' => strtolower($data['firstName']),
            'lastName' => strtolower($data['lastName']),
            'username' => strtolower($data['username']),
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'bankName' => strtolower($data['bankName']),
            'accountName' => strtolower($data['accountName']),
            'accountNumber' => $data['accountNumber'],
            'ref' => $this->generateReferralLink(),
            'referredBy' => $data['ref']
        ]);
    }



    /**
     * generate refferral link
     */
    public function generateReferralLink() {
        $string = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        //initialize ref
        $ref = '';
        for($i=0; $i<=10; $i++) {
            $ref .= $string[(int)ceil(mt_rand(0,61))]; 
        }
        return $ref;
    }
}
