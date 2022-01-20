<?php

namespace App\Http\Controllers\admin;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Organization;

class AdminProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::latest()->paginate(20);
        $organizations = Organization::latest()->paginate(10);

        return view('admin.profiles.index', ['profiles' => $profiles], ['organizations' => $organizations]);
    }

    public function destroy(Profile $profile, Request $request)
    {
        $profile->delete();

        return back()->with('message', 'Profile has been deleted');
    }

    public function show(Organization $organization)
    {

        $profiles = $organization->profile()->latest()->paginate(20);

        return view('admin.profiles.profiles', [
            'profiles' => $profiles,
            'organizations' => $organization
        ]);
    }
}
