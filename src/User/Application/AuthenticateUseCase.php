<?php


namespace Src\User\Application;

use Src\User\Domain\Entities\UserEntity;
use Src\User\Domain\Exceptions\UserNotFoundException;
use Src\User\Domain\Repositories\UserRepositoryInterface;

class AuthenticateUseCase
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(array $credentials)
    {
        $user = $this->userRepository->credentials($credentials);

        if (!$user) {
            throw new UserNotFoundException('User not found');
        }

        return UserEntity::create($user);
    }
}
