<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHandler;
use Closure;
use Illuminate\Http\Request;
use Src\User\Application\FindUserUseCase;
use Src\User\Infrastucture\Repositories\EloquestUserRepository;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $token = $request->bearerToken();
            $decodedToken = $this->validateToken($token);

            if (!$decodedToken) {
                return ResponseHandler::errors(['error' => 'Token invalid'], 401);
            }

            $request->user = (new FindUserUseCase(new EloquestUserRepository()))->execute(['id' => $decodedToken['sub']]);

        }catch (\Exception $e) {

            return ResponseHandler::errors(['error' => 'Token expired'], 401);
        }

        return $next($request);
    }

    public function validateToken($token)
    {
        $token = new \Tymon\JWTAuth\Token($token);
        return JWTAuth::manager()->decode($token, env('JWT_SECRET'), ['HS256']);
    }
}
