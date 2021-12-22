<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Token;

class AuthApiController extends Controller
{
    public function createToken(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $token = \Str::random(999, 9999);
        
        $data = Token::create([
            'name' => $name,
            'email' => $email,
            'token' => $token
        ]);

        return $data;
    }
}
