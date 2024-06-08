<?php

namespace App\Services;

use Tymon\JWTAuth\Facades\JWTAuth;
use Src\User\Domain\Entities\UserEntity;

class AuthService
{
    public function createToken(UserEntity $user)
    {
        $customClaims = [
            'iss' => 'jwt',
            'sub' => $user->getId()->value(),
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24)
        ];

        $payload = JWTAuth::factory()->customClaims($customClaims)->make();
        $token = JWTAuth::manager()->encode($payload)->get();

        return $token;
    }

}
