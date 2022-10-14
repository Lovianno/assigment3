<?php

namespace App\Http\Controllers;
use App\ServiceRepository\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct() {
		$this->AuthService = new AuthService();
	}

    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;
        $credentials = [
            'email' => $email,
            'password' => $password
        ];
        $token = Auth::attempt($credentials);
         if(!$token){
            return response()->json(['error' => 'Unauthorized'], 401);
         }
         return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
    public function logout(){
        auth()->logout();
        return response()->json([
            'msg' => 'successfully logged out'
        ], 200);
    }
    public function refresh(){
            return response()->json([
            'access_token' => Auth::refresh(),
            'token_type' => 'bearer',
            'expires_in' => 60*60
        ]);
    }
    public function data(){
        return response()->json(auth()->user());
    }

public function register(Request $request){
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
      $user =  $this->AuthService->addUser($validatedData);
        
      $token = auth('api')->attempt([
        'email' => $user->email,
        'password' => $request->password
     ]);
     
         if(!$token){
            return response()->json(['error' => 'Unauthorized'], 401);
         }
         return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);

    
    }
}
