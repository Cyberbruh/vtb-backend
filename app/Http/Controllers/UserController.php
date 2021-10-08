<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'age' => 'required',
            'experience' => 'required',
            'blueprint' => 'required|unique:users'
        ]);
        if ($validator->fails())
            return response()->json($validator->messages(), 400);
        $data = $request->all();
        $user = User::create([
            'age' => $data['age'],
            'experience' => $data['experience'],
            'blueprint' => $data['blueprint'],
            'token' => '1234',
        ]);
        Auth::login($user);
        $token = $user->createToken('api_token');
        return response()->json(['token' => $token->plainTextToken]);
    }
}
