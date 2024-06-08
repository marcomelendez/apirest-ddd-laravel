<?php

namespace Src\User\Domain\ValueObject;

class UserActivate
{
    protected bool $activate;

    public function __construct(bool $activate)
    {
        $this->activate = $activate;
    }

    public function value(): bool
    {
        return $this->activate;
    }
}
