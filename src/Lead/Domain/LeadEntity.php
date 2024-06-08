<?php

declare(strict_types=1);

namespace Src\Lead\Domain;

use DateTime;
use Src\Lead\Domain\ValueObject\LeadId;
use Src\Lead\Domain\ValueObject\CreatedAt;
use Src\Lead\Domain\ValueObject\CreatedBy;
use Src\Lead\Domain\ValueObject\NameValueObject;
use Src\Lead\Domain\ValueObject\Owner;
use Src\Lead\Domain\ValueObject\Source;

final class LeadEntity
{
    private LeadId $id;

    private NameValueObject $name;

    private Source $source;

    private Owner $owner;

    private CreatedBy $createdBy;

    private CreatedAt $createdAt;

    /**
     * @param LeadId $id
     * @param NameValueObject $name
     * @param Source $source
     * @param Owner $owner
     * @param CreatedBy $createdBy
     * @param CreatedAt $createdAt
     */
    public function __construct(
        LeadId $id,
        NameValueObject $name,
        Source $source,
        Owner $owner,
        CreatedBy $createdBy,
        CreatedAt $createdAt
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->source = $source;
        $this->owner = $owner;
        $this->createdBy = $createdBy;
        $this->createdAt = $createdAt;
    }

    public function getId(): LeadId
    {
        return $this->id;
    }

    public function getName(): NameValueObject
    {
        return $this->name;
    }

    public function getSource(): Source
    {
        return $this->source;
    }

    public function getOwner(): Owner
    {
        return $this->owner;
    }

    public function getCreatedBy(): CreatedBy
    {
        return $this->createdBy;
    }

    public function getCreatedAt(): CreatedAt
    {
        return $this->createdAt;
    }

    public static function create(array $data): self
    {
        return new self(
            new LeadId($data['id'] ?? null),
            new NameValueObject($data['name']),
            new Source($data['source']),
            new Owner((int) $data['owner']),
            new CreatedBy($data['created_by']),
            new CreatedAt($data['created_at'])
        );
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $createdAt = $this->getCreatedAt()->value();

        return [
            'id'        => $this->getId()->value(),
            'name'      => $this->getName()->value(),
            'source'    => $this->getSource()->value(),
            'owner'     => $this->getOwner()->value(),
            'created_by' => $this->getCreatedBy()->value(),
            'created_at' => $createdAt->format('Y-m-d H:m:s'),
        ];
    }
}
