<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends ApiController
{
    public function login(Request $request)
    {
        // dd(Auth::attempt($request->only(['email', 'password'])));
            if(!Auth::attempt($request->only(['email', 'password']))){
                return $this->error([],'accès incorrect',401);
            }else{
                $user = User::where('email', $request->email)->first();
                return $this->success(['token' => $user->createToken('API')->plainTextToken],'Connexion réussit');
            }
    }

    public function logout(Request $request)
    {
        User::where('email', $request->email)->first()->tokens()->delete();

        return $this->success([],'Déconnexion réussit');

    }

}
