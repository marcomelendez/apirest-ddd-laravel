<?php

namespace Src\User\Domain\ValueObject;

class UserName
{
    protected string $userName;

    public function __construct(string $userName)
    {

        $this->userName = $userName;
    }

    public function value(): string
    {
        return $this->userName;
    }
}
