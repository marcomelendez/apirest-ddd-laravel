<?php

declare(strict_types=1);

namespace Src\Lead\Application;

use Src\Lead\Domain\Exceptions\LeadNotFoundException;
use Src\Lead\Domain\LeadEntity;
use Src\Lead\Domain\Repositories\LeadRepositoryInterface;

class GetLeadsUseCase
{
    private $leadRepository;

    public function __construct(LeadRepositoryInterface $leadRepository)
    {
        $this->leadRepository = $leadRepository;
    }

    public function execute()
    {
        $colLeads = [];
        $leads    = $this->leadRepository->all();

        if (!$leads) {
            throw new LeadNotFoundException('Leads not found.');
        }

        foreach ($leads as $Lead) {
            $colLeads[] = LeadEntity::create($Lead);
        }

        return  $colLeads;
    }
}
