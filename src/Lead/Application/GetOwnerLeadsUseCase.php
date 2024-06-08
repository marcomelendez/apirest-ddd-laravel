<?php

declare(strict_types=1);

namespace Src\Lead\Application;

use Src\Lead\Domain\LeadEntity;
use Src\Lead\Domain\Repositories\LeadRepositoryInterface;

class GetOwnerLeadsUseCase
{
    private $leadRepository;

    public function __construct(LeadRepositoryInterface $leadRepository)
    {
        $this->leadRepository = $leadRepository;
    }

    public function execute($id)
    {

        $colLeads = [];
        $leads = $this->leadRepository->findByOwnerId($id);

        foreach ($leads as $lead) {
            $colLeads[] = LeadEntity::create($lead);
        }

        return  $colLeads;
    }
}
