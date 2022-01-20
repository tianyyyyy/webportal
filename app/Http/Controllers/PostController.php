<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(8);
        $events = Event::orderBy('start', 'ASC')->get();

        return view('posts.index', [
            'posts' => $posts,
            'events' => $events
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
            'file' => 'required|mimes:png,jpg,jpeg|max:5048',
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
        $request->user()->posts()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
            'published' => $request->published,
            'status' => $request->status,
            'file' => $fileNameToStore,
            'topic' => $request->topic
        ]);

        return back()->with('message', 'Your post has been submitted to the admin wait for publish');
    }

    public function destroy(Post $post, Request $request)
    {

        $post->delete();

        return back()->with('message', 'Your post has been deleted');
    }

    public function show(Post $post)
    {

        return view('posts.show', [
            'post' => $post
        ]);
    }
}
