<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClusterRequest;
use App\Http\Requests\UpdateClusterRequest;
use App\Models\Cluster;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ClusterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     * @throws Exception
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()
                ->of(Cluster::query())
                ->addColumn('action', function (Cluster $cluster) {
                    return '<div class="dropdown">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" >
                                    <a class="dropdown-item js-edit" href="#"
                                       data-id="' . $cluster->id . '" data-name="' . $cluster->name . '" data-expiration_date="' . $cluster->expiration_date->format('Y-m-d') . '">Edit</a>
                                    <a class="dropdown-item js-delete" href="' . route("admin.cluster.delete", $cluster->id) . '" >Delete</a>
                                </div>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.clusters.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClusterRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(StoreClusterRequest $request)
    {
        $data = $request->validated();
        $id = $request->input('id');

        if ($id > 0) {
            $cluster = Cluster::find($id);
            $cluster->update($data);
        } else {
            $cluster = Cluster::create($data);
        }

        if ($request->ajax()) {
            return response()
                ->json(['success' => 'Cluster saved successfully.']);
        }
        return redirect()
            ->route('clusters.index')
            ->with('success', 'Cluster saved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Cluster $cluster
     * @return JsonResponse
     */
    public function destroy(Cluster $cluster)
    {
        $cluster->delete();
        return response()
            ->json(['success' => 'Cluster deleted successfully.']);
    }
}
