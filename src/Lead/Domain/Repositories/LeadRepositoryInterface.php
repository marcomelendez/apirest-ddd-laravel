<?php

namespace Src\Lead\Domain\Repositories;

use App\Models\Lead;
use Src\Lead\Domain\LeadEntity;

interface LeadRepositoryInterface
{
    public function all();

    public function find($id);

    public function save(LeadEntity $lead): LeadEntity;

    public function findByOwnerId($id);
}
