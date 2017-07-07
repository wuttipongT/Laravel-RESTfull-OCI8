<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Api\V1\Requests\SignUpRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
class SignUpController extends Controller
{
    //
    public function signUp(SignUpRequest $request, JWTAuth $JWTAuth){
      $user = new User($request->all());
       if(!$user->save()) {
           throw new HttpException(500);
       }
       if(!env('SIGN_UP_RELEASE_TOKEN')) {
           return response()->json([
               'status' => 'ok'
           ], 201);
       }
       $token = $JWTAuth->fromUser($user);
       return response()->json([
           'status' => 'ok',
           'token' => $token
       ], 201);
    }
}
