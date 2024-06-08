<?php

namespace App\Http\Controllers;

use App\Helpers\Authorization;
use App\Helpers\ResponseHandler;
use App\Services\LeadCache;
use Illuminate\Auth\Access\AuthorizationException;
use Src\Lead\Application\CreateLeadUseCase;
use Src\Lead\Infrastructure\Repositories\EloquentLeadRepository;
use Illuminate\Http\Request;
use Src\Lead\Application\GetLeadUseCase;
use Src\Lead\Domain\Exceptions\LeadNotFoundException;

class LeadController extends Controller
{
    private $leadCache;

    public function __construct(LeadCache $leadCache)
    {
        $this->leadCache = $leadCache;
    }

    public function index()
    {
        try {
            $leads = $this->leadCache->getLeads();
            $leads = array_map(function($lead){
                return $lead->toArray();
            }, $leads);

            return ResponseHandler::success($leads);

        }catch (LeadNotFoundException $e) {

            return ResponseHandler::errors([$e->getMessage()],401);
        }
    }

    public function store(Request $request)
    {
        try {

            Authorization::check($request->user);

            $createLeadUseCase = new CreateLeadUseCase(new EloquentLeadRepository());

            $data = $request->all();

            $lead = $createLeadUseCase->execute([
                'name'   => $data['name'],
                'source' => $data['source'],
                'owner'  => $data['owner'],
                'created_by' => $request->user['id'],
                'created_at' => $data['created_at'] ?? date('Y-m-d H:i:s')
            ]);

            return ResponseHandler::success($lead->toArray(),201);

        }catch (AuthorizationException $e) {
            return ResponseHandler::errors(['Token expired'],401);
        }

    }

    public function show($id)
    {
        try {
            $createController = new GetLeadUseCase(new EloquentLeadRepository());
            $lead = $createController->execute($id);

            return ResponseHandler::success($lead->toArray());


        }catch (\Exception $e) {
            return response()->json(['error' => 'No lead found'], 404);
        }
    }
}
