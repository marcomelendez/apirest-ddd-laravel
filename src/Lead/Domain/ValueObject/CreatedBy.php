<?php

namespace Src\Lead\Domain\ValueObject;

use Src\Lead\Domain\Exceptions\ValueNullException;

class CreatedBy
{
    private $createdBy;

    public function __construct(int $value)
    {
        if ($value <= 0) {
            throw new ValueNullException("The value must be greater than 0.");
        }
        $this->createdBy = $value;
    }

    public function value()
    {
        return $this->createdBy;
    }
}
