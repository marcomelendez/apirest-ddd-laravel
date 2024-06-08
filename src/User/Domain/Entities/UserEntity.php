<?php

namespace Src\User\Domain\Entities;

use Src\User\Domain\ValueObject\UserActivate;
use Src\User\Domain\ValueObject\UserId;
use Src\User\Domain\ValueObject\UserLastLogin;
use Src\User\Domain\ValueObject\UserName;
use Src\User\Domain\ValueObject\UserPassword;
use Src\User\Domain\ValueObject\UserRole;

class UserEntity
{
    private UserId $id;

    private UserName $username;

    private UserPassword $password;

    private UserLastLogin $lastLogin;

    private UserActivate $activate;

    private UserRole $role;


    public function __construct(
        UserId $id,
        UserName $userName,
        UserLastLogin $lastLogin,
        UserActivate $activate,
        UserRole $role
    ) {
        $this->id = $id;
        $this->username  = $userName;
        $this->lastLogin = $lastLogin;
        $this->activate  = $activate;
        $this->role      = $role;
    }

    public function setPassword($value)
    {
        $this->password = new UserPassword($value);
    }

    /**
     * @return UserId
     */
    public function getId(): UserId
    {
        return $this->id;
    }

    /**
     * @return UserName
     */
    public function getUserName(): UserName
    {
        return $this->username;
    }

    /**
     * @return UserPassword
     */
    public function getPassword(): UserPassword
    {
        return $this->password;
    }

    /**
     * @return UserLastLogin
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * @return UserActivate
     */
    public function getActivate()
    {
        return $this->activate;
    }

    /**
     * @return UserRole
     */
    public function getRole()
    {
        return $this->role;
    }

    public static function create(array $data): self
    {
        return new self(
            new UserId($data['id']),
            new UserName($data['username']),
            new UserLastLogin(new \DateTime($data['last_login'])),
            new UserActivate($data['is_active']),
            new UserRole($data['role'])
        );
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId()->value(),
            'username' => $this->getUserName()->value(),
            'activate' => $this->getActivate()->value(),
            'role' => $this->getRole()->value(),
            'last_login' => $this->getLastLogin()->value()->format('Y-m-d H:i:s'),
        ];
    }
}
