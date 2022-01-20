<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);


        $email = $request->email;
        $password = $request->password;

        if (!Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1])) {
            return back()->with('error', 'Invalid login details');
        } else {
            return redirect()->route('posts')->with('message', 'You are logged in');
        }
    }
}
