<?php

namespace App\Http\Controllers\Auth;

use JWTAuth;
use Response;
use App\Models\User;
use JWTAuthException;
use App\Http\Requests;
use App\Helpers\Result;
use Tymon\JWTAuth\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTExcepetion;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class ApiAuthController extends Controller
{

    public function __construct()
    {
        $this->user = new User;
    }

    public function login(Request $request)
    {
        $result = new Result();
        $credentials = $request->only('username', 'password');

        $jwt = '';

        try 
        {
            if (!$jwt = JWTAuth::attempt($credentials))
             {
                $result->internalMessage = 'erro: invalid_credentials';
                $result->setCode(401);

                return Response::json($result, $result->code);
             }
        } 
        catch (JWTAuthException $e)
        {
            $result->internalMessage = 'erro: failed_to_create_token';
            $result->setCode(401);

            return Response::json($result, $result->code);
        }
        catch(Exception $e){
            $result->internalMessage = 'erro: failed_to_login';
            $result->setCode(500);
            return Response::json($result, $result->code);
       }

        $token = new Token($jwt);
        $user_id = JWTAuth::manager()->decode($token, false)->get('sub');

        $result->internalMessage = 'sucess';
        $result->setCode(200);

        $response['records'] = User::findOrFail($user_id);
        $response['token'] = $jwt;
        $response['result'] = $result;

        return Response::json($response, $result->code);
    }

    public function logout(Request $request)
    {
        $result = new Result();

        try 
        {
            JWTAuth::parseToken()->invalidate();
            $result->internalMessage = 'sucess';
            $result->setCode(200);
            return Response::json($result, $result->code);
        } 
        catch (TokenExpiredException $e) {
            $result->internalMessage = 'erro: Token expirado.';
            $result->setCode(500);
            return Response::json($result, $result->code);
        }
        catch (JWTException $e) {
            $result->internalMessage = 'erro: Failed to logout, please try again.';
            $result->setCode(500);
            return Response::json($result, $result->code);
        }
        catch(Exception $e){
            $result->internalMessage = 'erro: Failed to logout, please try again.';
            $result->setCode(500);
            return Response::json($result, $result->code);
       }
    }
}