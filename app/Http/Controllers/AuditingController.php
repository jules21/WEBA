<?php

namespace App\Http\Controllers;

use App\Constants\Permission;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;
use Yajra\DataTables\DataTables;

class AuditingController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if (! $user->can(Permission::ManageSystemAudit)) {
            abort(403);
        }
        $user->load('operationArea', 'operator');
        if ($request->ajax()) {
            $audits = Audit::query()
                ->with(['user'])
                ->when($user->operator_id, function ($q) use ($user) {
                    $q->whereHas('user', function ($q) use ($user) {
                        $q->where('operator_id', '=', $user->operator_id);
                    });
                })
                ->when($user->operation_area, function ($q) use ($user) {
                    $q->whereHas('user', function ($q) use ($user) {
                        $q->where('operation_area', '=', $user->operation_area);
                    });
                })
                ->when($request->start_date, function ($q) use ($request) {
                    $q->whereDate('created_at', '>=', $request->start_date);
                })
                ->when($request->end_date, function ($q) use ($request) {
                    $q->whereDate('created_at', '<=', $request->end_date);
                })->when($request->event, function ($q) use ($request) {
                    $q->where('event', '=', $request->event);
                })->when($request->model, function ($q) use ($request) {
                    $q->where('auditable_type', 'LIKE', '%'.$request->model.'%');
                })
                ->orderBy('id', 'desc')->select('audits.*');

            return $this->formatDataTableValue($audits);
        }

        return view('admin.audits');
    }

    public function formatDataTableValue($audits)
    {
        return Datatables::of($audits)
            ->addIndexColumn()
            ->editColumn('created_at', function ($item) {
                return $item->created_at;
            })->addColumn('user_name', function ($item) {
                return $item->user->name ?? '-';
            })->addColumn('model', function ($item) {
                return str_replace('App\\', '', $item->auditable_type);
            })
            ->addColumn('formatted_old_values', function ($item) {
                $oldValue = '<ul style="padding-left: 0 !important;margin-left: 5px !important;">';
                foreach ($item->old_values as $value) {
                    $oldValue .= '<li>';
                        $oldValue .= $value;
                    $oldValue .= '</li>';

                }
                $oldValue .= ' </ul>';

                return $oldValue;
            })->addColumn('formatted_new_values', function ($item) {
                $newValue = '<ul style="padding-left: 0 !important;margin-left: 5px !important;">';
                foreach ($item->new_values as $value) {
                    $newValue .= '<li>';
                        $newValue .= $value;
                }
                $newValue .= ' </ul>';

                return $newValue;
            })
            ->rawColumns(['action', 'formatted_old_values', 'index', 'formatted_new_values'])
            ->make(true);
    }

    public function customAudits($start, $end)
    {

        $start_date = $start;
        $end_date = $end;
        $audits = Audit::whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->get();

        return view('admin.audits', compact('audits', 'start_date', 'end_date'));
    }

    public function destroy($id)
    {
        $audit = Audit::find($id);
        $audit->delete();

        return redirect()->back()->with('success', 'Audit Destroyed');
    }
}
