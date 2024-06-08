<?php

declare(strict_types=1);

namespace Src\Lead\Application;

use Src\Lead\Domain\LeadEntity;
use Src\Lead\Domain\Repositories\LeadRepositoryInterface;

use Src\Lead\Domain\Exceptions\LeadNotFoundException;

final class CreateLeadUseCase
{
    private  $leadRepository;

    public function __construct(LeadRepositoryInterface $leadRepository)
    {
        $this->leadRepository = $leadRepository;
    }

    public function execute(array $data)
    {
        $lead = LeadEntity::create($data);
        $result = $this->leadRepository->save($lead);

        if (!$result) {
            throw new LeadNotFoundException('Lead not saved.');
        }

        return $result;
    }
}
