<?php

namespace Tests\Unit\Lead\Infrastructure;

use Src\Lead\Infrastructure\Repositories\EloquentLeadRepository;
use Src\Lead\Domain\LeadEntity;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Support\Facades\Facade;

class EloquentLeadRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private $userManager;
    private $userAgent;

    public function setUp(): void
    {
        parent::setUp();
        Facade::clearResolvedInstances();

        $this->userManager = User::factory()->create(['role'=>'MANAGER']);
        $this->userAgent = User::factory()->create(['role'=>'AGENT']);
        Lead::factory()->count(3)->create();
    }

    public function testGetAllCantidates(): void
    {
        $repository = new EloquentLeadRepository();
        $result = $repository->all();
        $this->assertCount(3, $result);
    }

    public function testFind(): void
    {
        $repository = new EloquentLeadRepository();
        $result = $repository->find(1);
        $this->assertEquals(1, $result->id);
    }

    public function testSave(): void
    {
        $leadEntity = LeadEntity::create([
            'id' => null,
            'name' => 'John Doe',
            'source' => 'LinkedIn',
            'owner' => $this->userAgent->id,
            'created_by' => $this->userAgent->id,
            'created_at' => '2024-06-01 00:00:00'
        ]);

        $repository = new EloquentLeadRepository();
        $repository->save($leadEntity);

        $this->assertDatabaseHas('leads', ['id' => '1']);
    }

    public function testFindByOwnerId(): void
    {
        $leads = Lead::factory()->count(3)->create(['owner' => '1']);

        $repository = new EloquentLeadRepository();
        $result = $repository->findByOwnerId('1');

        $this->assertCount(3, $result);
    }
}
