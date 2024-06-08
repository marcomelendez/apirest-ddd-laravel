<?php

declare(strict_types=1);

namespace Src\Lead\Application;

use Src\Lead\Domain\Exceptions\LeadNotFoundException;
use Src\Lead\Domain\Repositories\LeadRepositoryInterface;

class GetLeadUseCase
{
    private $leadRepository;

    public function __construct(LeadRepositoryInterface $leadRepository)
    {
        $this->leadRepository = $leadRepository;
    }

    public function execute(int $id)
    {
        $lead = $this->leadRepository->find($id);

        if (!$lead) {
            throw new LeadNotFoundException('Lead not found.');
        }

        return $lead;
    }
}
