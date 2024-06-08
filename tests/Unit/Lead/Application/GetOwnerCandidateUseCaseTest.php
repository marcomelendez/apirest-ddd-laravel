<?php

namespace Tests\Unit\Lead\Application;

use Mockery;
use Src\Lead\Application\GetOwnerLeadsUseCase;
use Src\Lead\Domain\Repositories\LeadRepositoryInterface;
use Tests\TestCase;

class GetOwnerLeadUseCaseTest extends TestCase
{
    public function testOwnerCantidateById(): void
    {
        $repositoryMock = Mockery::mock(LeadRepositoryInterface::class);
        $repositoryMock->shouldReceive('findByOwnerId')->andReturn([]);

        $useCase = new GetOwnerLeadsUseCase($repositoryMock);
        $result = $useCase->execute(1);

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    public function testOwnerCantidateByIdWithData()
    {
        $repositoryMock = Mockery::mock(LeadRepositoryInterface::class);
        $repositoryMock->shouldReceive('findByOwnerId')->andReturn([
            [
                'id' => 1,
                'name' => 'Test',
                'source' => 'Test source',
                'owner' => 1,
                'created_by' => 1,
                'created_at' => '2021-01-01 00:00:00'
            ]
        ]);

        $useCase = new GetOwnerLeadsUseCase($repositoryMock);
        $result = $useCase->execute(1);


        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertCount(1, $result);

        $row = $result[0]->toArray();
        $this->assertEquals(1,$row['id']);
        $this->assertEquals('Test', $row['name']);
        $this->assertEquals('Test source', $row['source']);
        $this->assertEquals(1, $row['owner']);
        $this->assertEquals(1, $row['created_by']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}
