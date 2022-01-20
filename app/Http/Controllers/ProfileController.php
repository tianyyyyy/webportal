<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Schlyr;
use App\Models\Profile;
use App\Models\Organization;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Schlyr $schlyrs, Organization $organizations, Profile $profiles)
    {
        $organizations = Organization::get();
        $schlyrs = Schlyr::get();
        $profiles = Profile::get();

        return view('profile.index', compact('schlyrs', 'organizations', 'profiles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:5048',
            'yrsec' => 'required',
            'age' => 'required',

        ]);

        // //handle file upload
        if ($request->hasFile('image')) {
            //get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //get just the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just the ext
            $extension = $request->file('image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //upload image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        //create post
        Profile::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'age' => $request->age,
            'yrsec' => $request->yrsec,
            'image' => $fileNameToStore,
            'position' => $request->position,
            'organization_id' => $request->organization_id,
            'schlyr_id' => $request->schlyr_id
        ]);

        return back()->with('message', 'Profile has been posted');
    }
}
