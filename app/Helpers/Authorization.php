<?php

namespace App\Helpers;

use Illuminate\Auth\Access\AuthorizationException;

class Authorization
{
    public static function check(array $user)
    {
        if ($user['role'] !== config('constant.roles.manager')) {
            throw new AuthorizationException('Unauthorized');
        }
    }
}
