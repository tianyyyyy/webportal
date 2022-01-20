<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Organization;
use App\Http\Controllers\Controller;
use App\Models\Schlyr;
use Illuminate\Http\Request;

class AdminOrganizationController extends Controller
{
    public function index()
    {

        $organizations = Organization::latest()->paginate(20);
        $schlyrs = Schlyr::latest()->get();

        return view('admin.organizations.index', ['organizations' => $organizations,], ['schlyrs' => $schlyrs]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:5048',
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
        Organization::create([
            'name' => $request->name,
            'image' => $fileNameToStore,
            'schlyr_id' => $request->schlyr_id
        ]);

        return back()->with('message', 'Organization has been created');
    }

    public function destroy(Organization $organization, Request $request)
    {

        $organization->delete();

        return back()->with('message', 'The organization is deleted');
    }

    public function edit($id)
    {

        $organization = Organization::find($id);
        $schlyrs = Schlyr::latest()->get();
        return view('admin.organizations.edit', compact('organization', 'schlyrs'));
    }

    public function update(Request $request, $id)
    {
        $schlyrs = Schlyr::latest();

        $this->validate($request, [
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:5048',
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

        $organization = Organization::findOrFail($id);

        $name = $request->input('name');
        $image = $fileNameToStore;
        $schlyr_id = $request->input('schlyr_id');


        $organization->name = $name;
        $organization->image = $image;
        $organization->schlyr_id = $schlyr_id;

        $organization->save();
        return back()->with('message', 'Organization is updated');
    }

    public function delete(Schlyr $schlyr, Request $request)
    {

        $schlyr->delete();

        return back()->with('message', 'The school year is deleted');
    }
}
