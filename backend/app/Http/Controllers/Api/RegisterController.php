<?php

namespace App\Http\Controllers\Api;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'password' => 'required|string|min:8',
            'email' => 'required|string|email|max:255',
        ]);

        $data = [
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email
        ];

        if (Author::where('email', $data['email'])->exists()) {
            return response()->json(['message' => 'Email already exists'], 409);
        }

        Author::create($data);

        return response()->json(['message' => 'Author registered successfully', 'data' => [
            'name' => $data['name'],
            'email' => $data['email']
        ]], 201);
    }
}
