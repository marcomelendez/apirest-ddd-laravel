<?php

namespace Tests\Unit\Lead\Domain;

use Src\Lead\Domain\LeadEntity;
use Src\Lead\Domain\ValueObject\LeadId;
use Src\Lead\Domain\ValueObject\CreatedAt;
use Src\Lead\Domain\ValueObject\CreatedBy;
use Src\Lead\Domain\ValueObject\NameValueObject;
use Src\Lead\Domain\ValueObject\Owner;
use Src\Lead\Domain\ValueObject\Source;
use Tests\TestCase;

final class LeadEntityTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testCreate(array $data): void
    {
        $lead = LeadEntity::create($data);

        $this->assertInstanceOf(LeadEntity::class, $lead);
        $this->assertInstanceOf(LeadId::class, $lead->getId());
        $this->assertInstanceOf(NameValueObject::class, $lead->getName());
        $this->assertInstanceOf(Source::class, $lead->getSource());
        $this->assertInstanceOf(Owner::class, $lead->getOwner());
        $this->assertInstanceOf(CreatedBy::class, $lead->getCreatedBy());
        $this->assertInstanceOf(CreatedAt::class, $lead->getCreatedAt());

        $this->assertEquals($data['id'], $lead->getId()->value());
        $this->assertEquals($data['name'], $lead->getName()->value());
        $this->assertEquals($data['source'], $lead->getSource()->value());
        $this->assertEquals($data['owner'], $lead->getOwner()->value());
    }

    /**
    * @dataProvider dataProvider
    */
    public function testToArray(array $data): void
    {
        $lead = LeadEntity::create($data);

        $array = $lead->toArray();

        $this->assertIsArray($array);
        $this->assertEquals($data['name'], $array['name']);
        $this->assertEquals($data['source'], $array['source']);
        $this->assertEquals($data['owner'], $array['owner']);
    }

    /**
     * @dataProvider dataProvider
     */
    public function dataProvider()
    {
        return [
            [
                [
                    'id' => 1,
                    'name' => 'John Doe',
                    'source' => 'Postulaciones',
                    'owner' => '1',
                    'created_by' => 1,
                    'created_at' => '2024-06-01 00:00:00'
                ]
            ],
        ];
    }
}
