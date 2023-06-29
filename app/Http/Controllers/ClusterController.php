<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClusterRequest;
use App\Http\Requests\UpdateClusterRequest;
use App\Models\Cluster;
use App\Models\District;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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
            $source = Cluster::query()
                ->when(isDistrict(), function ($query) {
                    return $query->where('district_id', auth()->user()->district_id);
                })->select('clusters.*');

            return datatables()
                ->of($source)
                ->addColumn('action', function (Cluster $cluster) {
                    return '<div class="dropdown">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" >
                                    <a class="dropdown-item js-edit" href="' . route('admin.cluster.show', $cluster->id) . '">Edit</a>
                                    <a class="dropdown-item js-delete" href="' . route("admin.cluster.delete", $cluster->id) . '" >Delete</a>
                                </div>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $districts = District::query()
            ->when(isDistrict(), function ($query) {
                return $query->where('id', auth()->user()->district_id);
            })->get();
        $waterNetworks = Cluster::query()
            ->when(isDistrict(), function ($query) {
                return $query->where('district_id', auth()->user()->district_id);
            })->get();

        return view('admin.clusters.index', [
            'districts' => $districts,
            'waterNetworks' => $waterNetworks
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClusterRequest $request
     * @return JsonResponse|RedirectResponse
     * @throws \Throwable
     */
    public function store(StoreClusterRequest $request)
    {
        $data = $request->validated();
        $id = $request->input('id');

        $arr = [
            'name' => $data['name'],
            'district_id' => $data['district_id'],
            'expiration_date' => $data['expiration_date']
        ];
        DB::beginTransaction();
        if ($id > 0) {
            $cluster = Cluster::find($id);
            $cluster->update($arr);
        } else {
            $cluster = Cluster::create($arr);
        }

        $cluster->sectors()->sync($data['sectors']);
        $cluster->waterNetworks()->sync($data['water_networks']);

        DB::commit();

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

    /**
     * @param Cluster $cluster
     * @return Cluster
     */

    public function show(Cluster $cluster)
    {
        $cluster->load(['sectors' => fn($query) => $query->select('id', 'name'), 'waterNetworks' => fn($query) => $query->select('id', 'name')]);
        return $cluster;
    }
}
