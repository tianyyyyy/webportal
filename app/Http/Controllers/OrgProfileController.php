<?php

namespace App\Http\Controllers;

use App\Models\Schlyr;
use App\Models\Profile;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrgProfileController extends Controller
{
    public function show(Organization $organization, Schlyr $schlyr)
    {
        $profiles = $organization->profile()->latest()->paginate(20);
        $organizations = $schlyr->organization()->latest()->get();
        return view('profile.show', [
            'profiles' => $profiles,
            'organizations' => $organization,
            'organizations' => $organizations,
        ]);
    }

    public function profiles(Organization $organization)
    {
        $profiles = $organization->profile()->latest()->paginate(20);

        return view('profile.profiles', [
            'profiles' => $profiles,
            'organizations' => $organization,
        ]);
    }
}
