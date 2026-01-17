<?php

namespace App\Http\Controllers\Admin;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    //

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $author = Author::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);



        return response()->json(['name' => $author->name, 'id' => $author->id], 400);
    }

    public function auth(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $author = Author::where('name', $request->name)->first();
        if (!$author || !Hash::check($request->password, $author->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        } else {
            return response()->json([
                "msg" => 'Authenticated',
                "access_token" => $author->createToken('auth_token')->plainTextToken
            ]);
        }
    }
}
