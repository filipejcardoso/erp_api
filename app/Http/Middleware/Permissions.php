<?php

namespace App\Http\Middleware;

use Closure;
use Response;
use App\Helpers\Roles;
use App\Helpers\Papel;
use App\Helpers\Result;
use App\Helpers\Helper;
use App\Exceptions\RoleException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class Permissions extends BaseMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try
        {
            $user = $this->auth->parseToken()->authenticate();

            if(!$this->verifyRole($user, $request))
                throw new RoleException();
            return $next($request);
        }

        catch(RoleException $e)
        {
            $result = new Result();
            $result->internalMessage = 'You are not allowed';
            $result->setCode(403);

            $response['result'] = $result;

            return Response::json($response, $result->code);
        }
    }

    /*private function verifyRole($user, $request)
    {
        $role = new Roles();

        $recurso = Helper::lastURI($request->route()->getPrefix());
        $verb = Helper::firstVerb($request->route()->methods());
        $crud = Helper::codeVerb($verb);

        return $role->isPermission($user, $recurso, $crud);
    }*/

    private function verifyRole($user, $request)
    {
        $papel = new Papel();

        $recurso = Helper::lastURI($request->route()->getPrefix());
        $verb = Helper::firstVerb($request->route()->methods());
        $crud = Helper::codeVerb($verb);

        return $papel->isPermission($user, $recurso, $crud);
    }
}
