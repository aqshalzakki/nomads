<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/email/verify';
    public function redirectTo()
    {
        rememberUserCache();
        
        $response = [
            'title'   => 'Account Created!',
            'message' => 'Your account has been created! please verify your email account.'
        ];

        session()->flash('emailSent', $response);
        return route('profile.index');
    }

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
        $errorMessages = [
            'password.regex' => 'Password must contain letters and numbers'
        ];
        return Validator::make($data, [
            'name'     => ['required', 'between:4,20'],
            'email'    => ['required', 'string', 'email', 'max:25', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex: ^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%])?.*$^'],
        ], $errorMessages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 1,
        ]);
    }
}
