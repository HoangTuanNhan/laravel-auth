<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/home';

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
            'name'                      => 'required|string|max:255',
            'email'                     => 'required|string|email|max:255|unique:users',
            'password'                  => 'required|min:6|max:30|confirmed',
            'password_confirmation'     => 'required|same:password',
        ],
        [
            'name.unique'               => trans('auth.nameTaken'),
            'name.required'             => trans('auth.nameRequired'),
            'email.required'            => trans('auth.emailRequired'),
            'email.email'               => trans('auth.emailInvalid'),
            'password.required'         => trans('auth.passwordRequired'),
            'password.min'              => trans('auth.PasswordMin'),
            'password.max'              => trans('auth.PasswordMax'),
         ]
        );
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
            'password' => bcrypt($data['password']),
            'token' => str_random(64),
        ]);
    }
}
