<?php

namespace Tests\Unit\User\Application;

use Tests\TestCase;
use Mockery;
use Src\User\Application\AuthenticateUseCase;
use Src\User\Domain\Entities\UserEntity;
use Src\User\Domain\Repositories\UserRepositoryInterface;
class AuthenticateUseCaseTest extends TestCase
{
    public function testAuthenticationSuccess()
    {
        $mokedUserRepository = Mockery::mock(UserRepositoryInterface::class);
        $mokedUserRepository->shouldReceive('credentials')->once()->andReturn([
            'id' => 1,
            'username' => 'testuser',
            'password' => 'password',
            'last_login' => '2024-01-01 00:00:00',
            'is_active' => true,
            'role' => 'MANAGER'
        ]);


        $useCase = new AuthenticateUseCase($mokedUserRepository);
        $response = $useCase->execute([
            'username' => 'testuser',
            'password' => 'password'
        ]);


        $this->assertInstanceOf(UserEntity::class, $response);
    }

    public function testAuthenticationFail()
    {
        $mokedUserRepository = Mockery::mock(UserRepositoryInterface::class);
        $mokedUserRepository->shouldReceive('credentials')->once()->andReturn([]);

        $useCase = new AuthenticateUseCase($mokedUserRepository);

        $this->expectExceptionMessage('User not found');
        $useCase->execute([
            'username' => 'testuser',
            'password' => 'password'
        ]);

    }
}
