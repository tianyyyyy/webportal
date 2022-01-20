<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPostsController extends Controller
{
    public function index()
    {

        $posts = Post::latest()->paginate(20);

        return view('admin.posts.index', [
            'posts' => $posts
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
            'file' => $fileNameToStore,
        ]);

        return back()->with('message', 'Your post has been posted');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', ['post' => $post]);
    }

    public function destroy(Post $post, Request $request)
    {

        $post->delete();

        return back()->with('message', 'The post is deleted');
    }

    public function publish($id)
    {
        $post = Post::find($id);

        if ($post->published === 0) {
            $post->published = 1;
            $post->save();
        } else {
            $post->published = 0;
            $post->save();
        }
        return back()->with('message', 'publish has been change');
    }
}
