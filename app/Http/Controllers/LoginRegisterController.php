<?php

namespace App\Http\Controllers;

use App\Models\LoginRegister;
use App\Http\Controllers\Controller;
use App\Jobs\SendVerification;
use App\Models\User;
use App\Models\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{

    public function loginPage()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = User::where($data)->first();

            Auth::login($user);
            
            if ($user->email_verified_at) {

                return redirect()->route('index');
            } else {

                $code = rand(100000, 1000000);

                VerifyEmail::create([
                    'user_id' => Auth::user()->id,
                    'code' => $code
                ]);

                SendVerification::dispatch(Auth::user()->email, $code);

                return view('email_verification');
            }
        }
        return redirect()->back();
    }

    public function registerPage()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        Auth::login($user);

        $code = rand(100000, 1000000);

        VerifyEmail::create([
            'user_id' => Auth::user()->id,
            'code' => $code
        ]);

        SendVerification::dispatch(Auth::user()->email, $code);

        return redirect()->route('verification');
    }

    public function verification()
    {
        return view('email_verification');
    }

    public function verify(Request $request){

        $user = VerifyEmail::where('user_id',Auth::user()->id)->first();


        if ($request->code == $user->code) {

            $user->delete();

            $the_user = User::where('id',Auth::user()->id)->first();

            $the_user->update([
                'email_verified_at' => now()
            ]);
            
            Auth::login($the_user);


            return redirect()->route('user.index');
        }
        
    }
}
