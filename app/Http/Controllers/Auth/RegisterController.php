<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\GeneratorService;
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

    use RegistersUsers;

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
            'referredBy' => ['string','max:255']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data,GeneratorService $generatorService)
    {
        if($data['ref']) {
            //get account with ref
           $userRef = User::where([
                'ref' => $data['ref']
            ])->first();
            //get sum of user's potential
            $sum = (int)$userRef->potential + 0.5;
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
            'ref' => $generatorService->generateReferralLink(),
            'referredBy' => $data['ref']
        ]);
    }
}
