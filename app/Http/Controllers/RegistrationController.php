<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Post;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(){

        return view('users.organizations.form');
    }

    public function store(Request $request){

        $this->validate($request,[
            'file' => 'required|mimes:pdf,docx,doc|max:8048',
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
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('file')->storeAs('public/files', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        //create post

        Registration::create([
            'file' => $fileNameToStore,
        ]);


        return back()->with('message', 'Your form has been submitted to the admin');
    }
}
