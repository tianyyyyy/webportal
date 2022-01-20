<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {

        $files = File::latest()->paginate(20);

        return view('users.files.index', [
            'files' => $files
        ]);
    }

    public function store(Request $request)
    {


        $this->validate($request, [
            'optradio' => 'required',
            'file' => 'required|mimes:doc,docx,pdf|max:5048',
        ]);

        // //handle file upload
        if ($request->hasFile('file')) {
            //get filename with the extension
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            //get just the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just the ext
            $extension = $request->file('file')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //upload image
            $path = $request->file('file')->storeAs('public/images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }


        //create post
        $request->user()->files()->create([
            'user_id' => auth()->id(),
            'optradio' => $request->optradio,
            'status' => $request->status,
            'file' => $fileNameToStore,
            'organization_id' => $request->organization_id,
            'schlyr_id' => $request->schlyr_id
        ]);


        return back()->with('message', 'Your file was submitted to the admin');
    }

    public function destroy(File $file, Request $request)
    {

        $file->delete();

        return back()->with('message', 'Your File has been deleted');
    }
}
