<?php

namespace Src\Lead\Domain\ValueObject;

use DateTime;
use InvalidArgumentException;

class CreatedAt
{
    private $createdAt;

    public function __construct(string $value = null)
    {
        try {
            $this->createdAt = new DateTime($value);
        } catch (\Exception $e) {
            throw new InvalidArgumentException("Invalid date format");
        }
    }

    public function value(): DateTime
    {
        return $this->createdAt;
    }
}
