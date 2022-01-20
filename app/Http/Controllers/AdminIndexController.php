<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminIndexController extends Controller
{
    public function index()
    {

        return view('admin.index');
    }
}
