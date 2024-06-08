<?php

namespace Src\User\Domain\ValueObject;

use DateTime;
use InvalidArgumentException;

class UserLastLogin
{
    protected $lastLogin;

    public function __construct(\DateTime $value)
    {
        $this->lastLogin = $value;
    }

    public function value(): \DateTime
    {
        return $this->lastLogin;
    }
}
