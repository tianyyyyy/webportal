<?php

namespace App\Http\Controllers\admin;

use App\Models\File;
use App\Models\User;
use App\Models\Schlyr;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminFileController extends Controller
{
    public function index()
    {
        $files = File::latest()->paginate(20);
        $organizations = Organization::latest()->get();
        $schlyrs = Schlyr::latest()->paginate(5);
        return view('admin.files.index', [
            'files' => $files,
            'organizations' => $organizations,
            'schlyrs' => $schlyrs
        ]);
    }

    public function show(Schlyr $schlyr, User $user)
    {
        $files = $user->files()->latest()->get();
        $organizations = $schlyr->organization()->latest()->get();
        $organization = Organization::latest()->get();
        //$posts = $user->posts()->with(['user', 'likes'])->latest()->paginate(20);
        return view('admin.files.show', ['organizations' => $organizations, 'files' => $files]);
    }

    public function files(File $file, Organization $organization)
    {
        $files = $organization->files()->latest()->get();

        //$posts = $user->posts()->with(['user', 'likes'])->latest()->paginate(20);
        return view('admin.files.files', [
            'files' => $files,
            'organizations' => $organization,
        ]);
    }

    public function status($id)
    {
        File::where(['status' => 0])->first()->update(['status' => 1]);

        return back()->with('message', 'Event has been archive');
    }

    public function download(Request $request, $file)
    {

        $path = public_path('storage/images/' . $file);
        return response()->download($path);
    }
}
