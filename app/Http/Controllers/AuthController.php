<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHandler;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Src\User\Application\AuthenticateUseCase;
use Src\User\Infrastucture\Repositories\EloquestUserRepository;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        try {

            $authenticate = new AuthenticateUseCase(new EloquestUserRepository());
            $user = $authenticate->execute(['username'=>$request->username, 'password'=>$request->password]);

            $token = $this->authService->createToken($user);
            return ResponseHandler::success(['token'=>$token, 'minute_to_expire'=>config('jwt.ttl')]);

        }catch (\Exception $e) {

            return ResponseHandler::errors(['Password incorrect for : '. $request->username]);
        }
    }
}
