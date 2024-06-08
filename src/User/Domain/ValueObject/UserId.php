<?php

namespace Src\User\Domain\ValueObject;

class UserId
{
    protected int $userId;

    public function __construct(int $userId = null)
    {
        $this->userId = $userId;
    }

    public function value(): ?int
    {
        return $this->userId;
    }
}
