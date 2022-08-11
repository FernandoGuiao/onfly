<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VerifyUser;
use DateTimeInterface;
use Illuminate\Support\Facades\Auth;
use Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt(['name' => $request->name, 'password' => $request->password])){ 
            $expiresIn = now()->addMinutes(config("lifetime"));
            $response = Auth::user()->createToken('Onfly', ['*'], $expiresIn)->plainTextToken;
            return response(["token" =>$response , "expiresIn" => $expiresIn],);
        }
        else{
            return response(["message" => 'Usuário ou senha inválidos'], 401);
        }
    }
}
