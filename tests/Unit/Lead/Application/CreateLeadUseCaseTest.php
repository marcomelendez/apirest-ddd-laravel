<?php

namespace Tests\Unit\Lead\Application;

use Mockery;
use Src\Lead\Application\CreateLeadUseCase;
use Src\Lead\Domain\LeadEntity;
use Src\Lead\Domain\Repositories\LeadRepositoryInterface;
use Tests\TestCase;
class CreateLeadUseCaseTest extends TestCase
{
    public function testCreateLead(): void
    {

        $data = [
            'id' => 1,
            'name' => 'John Doe',
            'source' => 'Postulaciones',
            'owner' => '1',
            'created_by' => 1,
            'created_at' => '2024-06-01 00:00:00'
        ];

        $lead = LeadEntity::create($data);

        $repositoryMock = Mockery::mock(LeadRepositoryInterface::class);
        $repositoryMock->shouldReceive('save')->with(Mockery::on(function ($arg) use ($lead) {
            return $arg == $lead;
        }))->andReturn($lead);


        $useCase = new CreateLeadUseCase($repositoryMock);
        $result = $useCase->execute($data);

        $this->assertInstanceOf(LeadEntity::class, $result);
        $this->assertEquals($lead, $result);

    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}
