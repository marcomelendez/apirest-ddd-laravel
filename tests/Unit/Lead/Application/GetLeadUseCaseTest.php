<?php

namespace Tests\Unit\Lead\Application;

use Mockery;
use Src\Lead\Application\GetLeadUseCase;
use Src\Lead\Domain\Exceptions\LeadNotFoundException;
use Src\Lead\Domain\Repositories\LeadRepositoryInterface;
use Tests\TestCase;

class GetLeadUseCaseTest extends TestCase
{
    public function testCantidateByIdWithReturnEmpty(): void
    {
        $repositoryMock = Mockery::mock(LeadRepositoryInterface::class);
        $repositoryMock->shouldReceive('find')->andReturn([]);

        $this->expectException(LeadNotFoundException::class);

        $useCase = new GetLeadUseCase($repositoryMock);
        $result = $useCase->execute(1);

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }
}
