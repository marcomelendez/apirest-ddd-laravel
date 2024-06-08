<?php

namespace Src\Lead\Domain\ValueObject;


class LeadId
{
    private $id;

    public function __construct(int $id = null)
    {
        $this->id = $id;
    }

    public function value(): ?int
    {
        return $this->id;
    }
}
