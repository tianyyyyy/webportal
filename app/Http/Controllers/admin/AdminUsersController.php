<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUsersController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);

        return view('admin.users.index', ['users' => $users]);
    }

    public function status($id)
    {
        $user = User::find($id);

        if ($user->status === 0) {
            $user->status = 1;
            $user->save();
        } else {
            $user->status = 0;
            $user->save();
        }
        return back()->with('message', 'status has been change');
    }

    public function admin($id)
    {
        $user = User::find($id);

        if ($user->admin === 0) {
            $user->admin = 1;
            $user->save();
        } else {
            $user->admin = 0;
            $user->save();
        }
        return back()->with('message', 'Role of a user has been change');
    }
}
