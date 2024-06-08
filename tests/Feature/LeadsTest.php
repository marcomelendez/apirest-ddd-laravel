<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Lead;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Src\User\Domain\Entities\UserEntity;
use Tests\TestCase;

class LeadsTest extends TestCase
{
    use RefreshDatabase;
    public function testCanRetrieveLeads()
    {
        $user = User::factory()->create([
            'id' => 1,
            'username' => 'testuser',
            'password' => 'password',
            'last_login' => '2024-01-01 00:00:00',
            'is_active' => true,
            'role' => 'MANAGER'
        ]);

        $userEntity = UserEntity::create($user->toArray());

        Lead::factory()->create([
            'id' => 1,
            'name' => 'testname',
            'source' => 'nihil',
            'owner' => 1,
            'created_by' => 1,
            'created_at' => '2024-06-06 19:06:02'
        ]);

        $authService = new AuthService();
        $token = $authService->createToken($userEntity);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/leads');


        $response->assertStatus(200);
        $response->assertJson([
            'meta' => [
                'success' => true,
                'errors' => [],
            ],
            'data' => [
                [
                    'id' => 1,
                    'name' => 'testname',
                    'source' => 'nihil',
                    'owner' => 1,
                    'created_by' => 1,
                    'created_at' => '2024-06-06 19:06:02',
                ],
            ],
        ]);
    }

    public function testShowLeadById()
    {
        $user = User::factory()->create([
            'id' => 1,
            'username' => 'testuser',
            'password' => 'password',
            'last_login' => '2024-01-01 00:00:00',
            'is_active' => true,
            'role' => 'MANAGER'
        ]);

        $userEntity = UserEntity::create($user->toArray());

        Lead::factory()->create([
            'id' => 1,
            'name' => 'testname',
            'source' => 'nihil',
            'owner' => 1,
            'created_by' => 1,
            'created_at' => '2024-06-06 19:06:02'
        ]);

        $authService = new AuthService();
        $token = $authService->createToken($userEntity);

         $response = $this->withHeaders([
         'Authorization' => 'Bearer ' . $token,
         ])->get('/api/lead/1');

        $response->assertStatus(200);
        $response->assertJson([
            'meta' => [
                'success' => true,
                'errors' => [],
            ],
            'data' => [
                'id' => 1,
                'name' => 'testname',
                'source' => 'nihil',
                'owner' => 1,
                'created_by' => 1,
                'created_at' => '2024-06-06 19:06:02',
            ],
        ]);
    }

    public function testCreateLead()
    {
        $user = User::factory()->create([
            'id' => 1,
            'username' => 'testuser',
            'password' => 'password',
            'last_login' => '2024-01-01 00:00:00',
            'is_active' => true,
            'role' => 'MANAGER'
        ]);

        $userEntity = UserEntity::create($user->toArray());

        $authService = new AuthService();
        $token = $authService->createToken($userEntity);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/lead', [
            'name' => 'testname',
            'source' => 'nihil',
            'owner' => 1,
            'created_by' => 1,
            'created_at' => '2024-06-06 19:06:02'
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'meta' => [
                'success' => true,
                'errors' => [],
            ],
            'data' => [
                'id' => 2,
                'name' => 'testname',
                'source' => 'nihil',
                'owner' => 1,
                'created_by' => 1,
                'created_at' => '2024-06-06 19:06:02',
            ],
        ]);
    }

    public function testCreateLeadWithRoleAgent()
    {
        $user = User::factory()->create([
            'id' => 1,
            'username' => 'testuser',
            'password' => 'password',
            'last_login' => '2024-01-01 00:00:00',
            'is_active' => true,
            'role' => 'AGENT'
        ]);

        $userEntity = UserEntity::create($user->toArray());

        $authService = new AuthService();
        $token = $authService->createToken($userEntity);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/lead', [
            'name' => 'testname',
            'source' => 'nihil',
            'owner' => 1,
            'created_by' => 1,
            'created_at' => '2024-06-06 19:06:02'
        ]);

        $response->assertStatus(401);
        $response->assertJson([
            'meta' => [
                'success' => false,
                'errors' => [
                    'Token expired'
                ],
            ],
        ]);
    }
}
