<?php

namespace App\Http\Controllers;

use App\Models\LoginRegister;
use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginRequest;
use App\Http\Requests\Login\RegisterRequest;
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

    public function login(LoginRequest $request)
    {
        $data = $request->all();

        $user = User::where('email', $data['email'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {

            Auth::login($user);

            return redirect()->route('index');  
        }

        return redirect()->back()->withErrors(['password'=> 'Password or Email is wrong']);
    }

    public function registerPage()
    {
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        
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


    public function verify(Request $request)
    {

        $user = VerifyEmail::where('user_id', Auth::user()->id)->first();


        if ($request->code == $user->code) {

            $user->delete();

            $the_user = User::where('id', Auth::user()->id)->first();

            $the_user->update([
                'email_verified_at' => now()
            ]);

            Auth::login($the_user);


            return redirect()->route('user.index');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login.main');
    }
}
