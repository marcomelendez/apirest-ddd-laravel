<?php

namespace Src\User\Domain\ValueObject;

class UserRole
{
    protected string $role;

    const ROLE_USER = ['MANAGER','AGENT'];

    public function __construct(string $role = 'AGENT')
    {
        if (!in_array($role, self::ROLE_USER)) {
            throw new \InvalidArgumentException("Invalid role");
        }

        $this->role = $role;
    }

    public function value(): string
    {
        return $this->role;
    }
}
