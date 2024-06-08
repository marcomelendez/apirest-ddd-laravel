<?php

namespace Tests\Unit\Lead\Application;

use Mockery;
use Src\Lead\Application\GetLeadsUseCase;
use Src\Lead\Domain\Exceptions\LeadNotFoundException;
use Src\Lead\Domain\Repositories\LeadRepositoryInterface;
use Tests\TestCase;

class GetLeadsUseCaseTest extends TestCase
{
    public function testAllLeadsEmpty(): void
    {
        $repositoryMock = Mockery::mock(LeadRepositoryInterface::class);
        $repositoryMock->shouldReceive('all')->andReturn([]);

        $this->expectException(LeadNotFoundException::class);
        $useCase = new GetLeadsUseCase($repositoryMock);
        $result = $useCase->execute();

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function testAllLeadWithData(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'John Doe',
                'source' => 'Postulaciones',
                'owner' => 1,
                'created_by' => 1,
                'created_at' => '2024-06-01 00:00:00'
            ]
        ];

        $repositoryMock = Mockery::mock(LeadRepositoryInterface::class);
        $repositoryMock->shouldReceive('all')->andReturn($data);

        $useCase = new GetLeadsUseCase($repositoryMock);
        $result = $useCase->execute();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertCount(1, $result);
    }
}
