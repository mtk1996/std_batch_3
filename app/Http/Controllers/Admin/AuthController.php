<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderGroup;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $cre = $request->only('email', 'password'); // ['email'=>'','password'=>'']
        if (auth()->attempt($cre)) {
            //login
            $user =  auth()->user(); //role
            if ($user->role === 'user') {
                auth()->logout();
                return redirect()->back()->with('error', 'You Are Not Admin');
            }
            //
            return redirect('/admin/')->with('success', 'Welcome Admin');
        }
        ///wrong email and password
    }

    public function home()
    {
        // ['Month',]
        // [1,2,3,4]
        $months = [date('F Y')];
        $year_month = [
            ['year' => date('Y'), 'month' => date('m')]
        ];

        for ($i = 1; $i <= 6; $i++) {
            $months[] = date('F Y', strtotime("-$i month"));

            $year_month[] = [
                'year' => date('Y', strtotime("-$i month")),
                'month' => date('m', strtotime("-$i month")),
            ];
        }

        $data = [];
        foreach ($year_month as $d) {
            $data[] =  OrderGroup::whereYear('order_date', $d['year'])
                ->whereMonth('order_date', $d['month'])
                ->count(); //inte
        }

        $user = User::where('role', 'user')->latest()->take(5)->get();

        return view('admin.home', compact('data', 'user', 'months'));
    }
}
