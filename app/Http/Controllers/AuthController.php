<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }


    public function login()
    {
        request()->validate([
            'email' => "required|email",
            'password' => "required",
        ]);
        //select id from users where email=$email
        $email = request()->email;
        $checkUser = User::where('email', $email)->first();
        if (!$checkUser) {
            return redirect()->back()->with('error', 'User Not Found');
        }

        //check password
        if (!Hash::check(request()->password, $checkUser->password)) {
            return redirect()->back()->with('error', 'Wrong Password');
        }

        auth()->login($checkUser);
        return redirect('/')->with('success', 'Welcome ' . auth()->user()->name);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => "required",
            'email' => "required|email",
            'password' => "required",
            'address' => "required",
            'phone' => "required"
        ]);

        //create user
        $user =   User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'address' => $request->address,
        ]);

        //auth login
        auth()->login($user);
        return redirect('/')->with('success', 'Welcome ' . auth()->user()->name);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }

    public function updatePassword(Request $request)
    {
        $old_password = $request->old_password;
        $new_password = $request->new_password;

        $db_password = User::where('id', auth()->id())->first()->password;

        if (Hash::check($old_password, $db_password)) {
            User::where('id', auth()->id())->update([
                'password' => Hash::make($new_password)
            ]);
            auth()->logout();
            return redirect('/login')->with('success', 'Your Password Updated.Please Login');
        } else {
            return redirect()->back()->with('error', 'Wrong Password');
        }
    }
}
