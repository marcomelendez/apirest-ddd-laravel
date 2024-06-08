<?php

namespace Src\Lead\Domain\ValueObject;

use Src\Lead\Domain\Exceptions\ValueNullException;

class Owner
{
    private $owner;

    public function __construct(int $value)
    {
        if ($value <=0) {
            throw new ValueNullException($value);
        }
        $this->owner = $value;
    }

    public function value()
    {
        return $this->owner;
    }
}
