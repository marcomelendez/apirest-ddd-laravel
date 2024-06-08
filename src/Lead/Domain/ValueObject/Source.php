<?php

namespace Src\Lead\Domain\ValueObject;

use Src\Lead\Domain\Exceptions\ValueNullException;

class Source
{
    private $source;

    public function __construct(string $value)
    {
        $this->source = $value;
    }

    public function value()
    {
        return $this->source;
    }

    public function setSource(string $source): void
    {
         if ($source === null) {
            throw new ValueNullException();
        }
        $this->source = $source;
    }
}
