<?php

namespace App\Http\Controllers;

use App\Models\LoginRegister;
use App\Http\Controllers\Controller;
use App\Jobs\SendVerification;
use App\Models\User;
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

            if ($user->email_verified_at) {

                return redirect()->route('index');
            } else {

                $code = rand(100000, 1000000);

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

        SendVerification::dispatch(Auth::user()->email, $code);

        return redirect()->route('verification');
    }

    public function verification()
    {
        return view('email_verification');
    }
}
