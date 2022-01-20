<?php

namespace App\Http\Controllers\admin;

use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminRegistrationsController extends Controller
{
    public function index()
    {

        $registrations = Registration::latest()->get();
        return view('admin.registrations.index', ['registrations' => $registrations]);
    }

    public function download(Request $request, $file)
    {

        $path = public_path('storage/files/' . $file);
        return response()->download($path);
    }

    public function destroy(Registration $registration, Request $request)
    {

        $registration->delete();

        return back()->with('message', 'The File is deleted');
    }
}
