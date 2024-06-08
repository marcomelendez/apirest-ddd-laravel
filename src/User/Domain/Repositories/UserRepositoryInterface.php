<?php

namespace Src\User\Domain\Repositories;

use App\Models\User;
use Src\User\Domain\Entities\UserEntity;

interface UserRepositoryInterface
{
    public function credentials(array $data): array;

    public function findById($id): array;
}
