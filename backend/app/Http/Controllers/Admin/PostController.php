<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //
    public function index()
    {
        $post = Post::with('author')->paginate(10);;

        return view('restapi.index')->with([
            'posts' => $post
        ]);
    }

    public function show($id)
    {


        $post = Post::with('author')->find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json($post, 200);
    }

    public function create()
    {
        $author = Author::all();
        return view('restapi.create')->with([
            'authors' => $author
        ]);
    }

    public function store(Request $request)
    {   
        $author = $request->author()->id;

        $request->validate([
            'title' => 'required|string|max:1000',
            'content' => 'required|string|max:1000',
            
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->input('content'),
            'author_id' => $author
        ];

        Post::create($data);

        return redirect()->route('admin.challenge3.index');
    }

    public function update(Request $request, $id)
    {

        $post = Post::findOrFail($id);
        $post->update($request->all());

        return response()->json($post, 200);
    }

    public function destroy($id)
    {

        Post::findOrFail($id)->delete();
        return redirect()->route('admin.challenge3.index');
    }
}
