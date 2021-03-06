<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use App\Helpers\Result;
use App\Helpers\Roles;
use App\Helpers\Helper;
use App\Exceptions\RoleException;
use Response;

class AuthToken extends BaseMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next) {

        $result = new Result();
        $this->checkForToken($request); // Check presence of a token.

        try 
        {
            $user = $this->auth->parseToken()->authenticate();
               
            $payload = $this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray();

            return $next($request); // Token is valid. User logged. Response without any token.
        } 

        catch (TokenExpiredException $t){ // Token expired. User not logged.
            try
            {
                $payload = $this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray();
                
                $key = 'block_refresh_token_for_user_' . $payload['sub'];
                
                $cachedBefore = (int) Cache::has($key);
                
                // If a token alredy was refreshed and sent to the client in the last JWT_BLACKLIST_GRACE_PERIOD seconds.
                
                if ($cachedBefore) 
                { 
                    \Auth::onceUsingId($payload['sub']); // Log the user using id.
                    return $next($request); // Token expired. Response without any token because in grace period.
                }

                $result->internalMessage = 'Token expirado';
                $result->setCode(440);
                $response['result'] = $result;
                return Response::json($response, $result->code);

            }
            
            catch (JWTException $e) {
                //Check user not found. Check token has expired.
                $result->internalMessage = $e->getMessage();
                $result->setCode(500);
                $response['result'] = $result;
                return Response::json($response, $result->code);
            }

            catch(Exception $e){
                $result->internalMessage = $e->getMessage();
                $result->setCode(500);
                $response['result'] = $result;
                return Response::json($response, $result->code);
           }
        }

        catch(JWTException $e){
            // $result->internalMessage = 'Token in Black List';
            $result->internalMessage = $e->getMessage();
            $result->setCode(500);
            $response['result'] = $result;
            return Response::json($response, $result->code);
       }
    }
}