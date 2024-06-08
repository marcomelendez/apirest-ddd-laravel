<?php


namespace Src\User\Infrastucture\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Src\User\Domain\Repositories\UserRepositoryInterface;

class EloquestUserRepository implements UserRepositoryInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function credentials(array $data): array
    {
        $user = $this->model->where('username', $data['username'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            return $user->toArray();
        }

        return [];
    }

    public function findById($id): array
    {
        $user = $this->model->find($id)->first();
        return !empty($user) ? $user->toArray() : [];
    }
}
