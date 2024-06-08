<?php

namespace Tests\Unit\Src\User\Domain\Entities;

use DateTime;
use PHPUnit\Framework\TestCase;
use Src\User\Domain\Entities\UserEntity;
use Src\User\Domain\ValueObject\UserActivate;
use Src\User\Domain\ValueObject\UserId;
use Src\User\Domain\ValueObject\UserLastLogin;
use Src\User\Domain\ValueObject\UserName;
use Src\User\Domain\ValueObject\UserPassword;
use Src\User\Domain\ValueObject\UserRole;

class UserEntityTest extends TestCase
{
    private $userEntity;
    const ROLE_MANAGER = "MANAGER";

    protected function setUp(): void
    {
        $this->userEntity = new UserEntity(
            new UserId(1),
            new UserName('testuser'),
            new UserLastLogin(new \DateTime()),
            new UserActivate(true),
            new UserRole(self::ROLE_MANAGER)
        );
    }

    public function testGetId()
    {
        $this->assertEquals(1, $this->userEntity->getId()->value());
    }

    public function testGetUserName()
    {
        $this->assertEquals('testuser', $this->userEntity->getUserName()->value());
    }

    public function testGetPassword()
    {
        $this->userEntity->setPassword('password');
        $this->assertEquals('password', $this->userEntity->getPassword()->value());
    }

    public function testGetLastLogin()
    {
        $this->assertInstanceOf(\DateTime::class, $this->userEntity->getLastLogin()->value());
    }

    public function testGetActivate()
    {
        $this->assertEquals(true, $this->userEntity->getActivate()->value());
    }

    public function testGetRole()
    {
        $this->assertEquals(self::ROLE_MANAGER, $this->userEntity->getRole()->value());
    }

    public function testCreate()
    {
        $data = [
            'id' => 1,
            'username' => 'testuser',
            'last_login' =>'2024-01-01 00:00:00',
            'is_active' => true,
            'role' => self::ROLE_MANAGER
        ];

        $userEntity = UserEntity::create($data);

        $this->assertInstanceOf(UserEntity::class, $userEntity);
        $this->assertEquals($data['id'], $userEntity->getId()->value());
        $this->assertEquals($data['username'], $userEntity->getUserName()->value());
        $this->assertEquals($data['is_active'], $userEntity->getActivate()->value());
        $this->assertEquals($data['role'], $userEntity->getRole()->value());
    }

    public function testToArray()
    {
        $array = $this->userEntity->toArray();

        $this->assertEquals(1, $array['id']);
        $this->assertEquals('testuser', $array['username']);
        $this->assertEquals(true, $array['activate']);
        $this->assertEquals(self::ROLE_MANAGER, $array['role']);
        $this->assertIsString($array['last_login']);
    }
}
