<?php

namespace Tests\Unit\User\Application;

use Tests\TestCase;
use Mockery;
use Src\User\Application\FindUserUseCase;
use Src\User\Domain\Repositories\UserRepositoryInterface;

class FindUserUseCaseTest extends TestCase
{
    public function testFindUserSuccess()
    {
        $mokedUserRepository = Mockery::mock(UserRepositoryInterface::class);
        $mokedUserRepository->shouldReceive('findById')->once()->andReturn([
            'id' => 1,
            'username' => 'testuser',
            'password' => 'password',
            'last_login' => new \DateTime(),
            'is_active' => true,
            'role' => 'MANAGER'
        ]);

        $useCase = new FindUserUseCase($mokedUserRepository);
        $response = $useCase->execute(1);

        $this->assertIsArray($response);
        $this->assertEquals(1, $response['id']);
    }

    public function testFindUserFail()
    {
        $mokedUserRepository = Mockery::mock(UserRepositoryInterface::class);
        $mokedUserRepository->shouldReceive('findById')->once()->andReturn([]);

        $useCase = new FindUserUseCase($mokedUserRepository);

        $this->expectExceptionMessage('User not found');
        $useCase->execute(1);
    }
}
