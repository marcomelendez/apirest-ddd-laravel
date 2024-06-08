<?php

namespace App\Services;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Cache;
use Src\Lead\Application\GetLeadsUseCase;
use Src\Lead\Application\GetOwnerLeadsUseCase;
use Src\Lead\Infrastructure\Repositories\EloquentLeadRepository;

class LeadCache
{
    private $leadRepository;

    private $user;

    public function __construct(EloquentLeadRepository $leadRepository)
    {
        $this->leadRepository = $leadRepository;
    }

    private function getCacheKey($id = null)
    {
        return 'leads_' . $id;
    }

    private function getLeadsFromCache($id)
    {
        return Cache::get($this->getCacheKey($id));
    }

    private function setCache($id, $leads)
    {
        Cache::put($this->getCacheKey($id), $leads, 60);
    }

    public function getLeads()
    {
        if (Request()->user) {
            $userId = Request()->user['id'];
            $role   = Request()->user['role'];
            $leads  = $this->getLeadsFromCache($userId);

            if (!$leads) {
                $leads = $this->getLeadsByRole($role);
                $this->setCache($userId, $leads);
            }

            return $leads;
        }
    }

    public function getLeadsByRole($role)
    {
        if ($role === config('constant.roles.manager')) {
            $getAllLeadsUseCase = new GetLeadsUseCase($this->leadRepository);
            return $getAllLeadsUseCase->execute();
        }

        $getOwnerLead = new GetOwnerLeadsUseCase($this->leadRepository);
        return $getOwnerLead->execute(Request()->user['id']);
    }


}
