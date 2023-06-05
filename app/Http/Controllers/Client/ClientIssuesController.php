<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIssueRequest;
use App\Models\Client;
use App\Models\IssueReport;
use App\Models\OperationArea;
use App\Models\Operator;
use DB;
use Throwable;

class ClientIssuesController extends Controller
{
    public function index()
    {


        $operators = Operator::query()
            ->with('operationAreas')
            ->whereHas('operationAreas')
            ->get();
        return view('client.issues-reported', [
            'operators' => $operators
        ]);
    }

    /**
     * @throws Throwable
     */
    public function store(StoreIssueRequest $request)
    {
        $data = $request->validated();
        $data['client_id'] = auth('client')->id();
        $data['district_id'] = OperationArea::query()->find($data['operation_area_id'])->district_id;
        $data['status'] = 'pending';
        $data['type'] = 'CUSTOMER';
        $description = $data['description'];
        unset($data['description']);
        DB::beginTransaction();
        $issue = IssueReport::query()->create($data);
        $issue->details()
            ->create([
                'description' => $description,
                'user_type' => Client::class,
                'user_id' => auth('client')->id(),
            ]);
        DB::commit();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Issue reported successfully',
                'issue' => $issue
            ]);
        }
        return redirect()->back()
            ->with('success', 'Issue reported successfully');
    }
}
