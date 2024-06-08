<?php

namespace Tests\Unit\User\Infrasturcture;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Src\User\Infrastucture\Repositories\EloquestUserRepository;
use Tests\TestCase;

class EloquestUserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function testCredentialsSuccess()
    {
        $user = User::factory()->create([
            'username' => 'testuser',
            'password' => Hash::make('password'),
        ]);

        $eloquestUserRepository = new EloquestUserRepository();
        $response = $eloquestUserRepository->credentials([
            'username' => 'testuser',
            'password' => 'password'
        ]);

        $this->assertIsArray($response);
        $this->assertEquals($user->id, $response['id']);
    }

    public function testCredentialFail()
    {

        User::factory()->create([
            'username' => 'testuser2',
            'password' => Hash::make('otherpassword'),
        ]);

        $eloquestUserRepository = new EloquestUserRepository();
        $response = $eloquestUserRepository->credentials([
            'username' => 'testuser',
            'password' => 'password'
        ]);

        $this->assertEmpty($response);
    }
}
