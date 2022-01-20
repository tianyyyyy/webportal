<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Schlyr;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Attempting;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $organizations = Organization::latest()->paginate(20);
        $schlyrs = Schlyr::latest()->get();
        return view('auth.register', [
            'organizations' => $organizations,
            'schlyrs' => $schlyrs
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
            'position' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'organization_id' => $request->organization_id,
            'schlyr_id' => $request->schlyr_id,
            'admin' => $request->admin,
            'password' => Hash::make($request->password),
            'position' => $request->position,
            'status' => $request->status
        ]);

        return redirect()->route('login')->with('message', 'You are now registered');
    }
}
