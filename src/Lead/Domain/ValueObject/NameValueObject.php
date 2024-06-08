<?php

namespace Src\Lead\Domain\ValueObject;

use Src\Lead\Domain\Exceptions\ValueNullException;

class NameValueObject
{
    private $name;

    public function __construct(string $value)
    {
        if ($value === null) {
            throw new ValueNullException();
        }

        $this->name = $value;
    }

    public function value()
    {
        return $this->name;
    }
}
