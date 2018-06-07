<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Services\SystemLog;
use Carbon\Carbon;
use Config;
use Mail;

class RegisterController extends Controller
{
    private $TABLE_NAME = "USERS";
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
    protected $redirectTo = '/';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        try {
            $content = 'Name: ['.$data['name'].'], Email: ['.$data['email'].'] User is registered in OKCC Home at '.Carbon::now().'.';
            // Ultimate Guide on Sending Email in Laravel
            // https://scotch.io/tutorials/ultimate-guide-on-sending-email-in-laravel
            Mail::send( 'contact', [ 'phone' => 'N/A', 'contentMessage' => $content ], function($mail) use($data) {
                $mail->from( $data['email'], $data['name'] );
                $mail->to( env('MAIL_FROM_ADDRESS', 'it.help@okcc.ca'), env('MAIL_FROM_NAME', 'OKCC Admin') );
                $mail->subject( 'Member Registration from OKCC Home' );
            });
            $resultRecord = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'privilege' => 99,
            ]);
            SystemLog::createLogForInsert($this->TABLE_NAME, $resultRecord);
            return $resultRecord;
        } catch (Exception $e) {
                return response()->json([ 'error' => $e->getMessage() ], $e->getCode());
        }
    }
}
