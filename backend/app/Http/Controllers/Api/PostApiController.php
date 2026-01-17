<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostApiController extends Controller
{
    //
    //
    public function index()
    {
        $post = Post::with('author')->paginate(10);;

        return response()->json($post, 200);
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


        return response()->json($author, 200);
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:1000',
            'content' => 'required|string|max:1000',
            'author_id' => 'required|exists:authors,id',
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->input('content'),
            'author_id' => $request->author_id
        ];

        Post::create($data);

        return response()->json($data, 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if ($post->author_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $post->update($request->all());

        return response()->json($post, 200);
    }

    public function destroy(Request $request, $id)
    {

        $post = Post::findOrFail($id);
        if ($post->author_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
