<?php

namespace Src\Lead\Infrastructure\Repositories;

use Src\Lead\Domain\LeadEntity;
use Src\Lead\Domain\Repositories\LeadRepositoryInterface;
use App\Models\Lead as LeadModel;

class EloquentLeadRepository implements LeadRepositoryInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new LeadModel();
    }

    public function all()
    {
        return $this->model->all()->toArray();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function save(LeadEntity $lead): LeadEntity
    {
        $this->model->fill($lead->toArray());
        $this->model->save();

        return LeadEntity::create($this->model->toArray());
    }

    public function findByOwnerId($id)
    {
        return $this->model->where('owner', $id)->get()->toArray();
    }
}
