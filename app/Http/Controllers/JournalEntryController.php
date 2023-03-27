<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateJournalEntryRequest;
use App\Models\ChartAccount;
use App\Models\JournalEntry;
use Exception;
use Illuminate\Http\JsonResponse;

class JournalEntryController extends Controller
{
    /**
     * @throws Exception
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = JournalEntry::query()
                ->with(['debitLedger', 'creditLedger'])
                ->where('operation_area_id', auth()->user()->operation_area)
                ->select('journal_entries.*');
            return datatables()->of($data)
                ->addColumn('action', function ($row) {
                    if (auth()->user()->operation_area) {
                        return '<div class="dropdown">
                          <button class="btn btn-light-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">
                            Options
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item js-edit" href="' . route('admin.accounting.journal-entries.show', encryptId($row->id)) . '"> <i class="fa fa-edit mr-2"></i> Edit</a>
                            <a class="dropdown-item js-delete" href="' . route('admin.accounting.journal-entries.delete', encryptId($row->id)) . '"> <i class="fa fa-trash  mr-2"></i> Delete</a>
                          </div>
                        </div>';
                    }
                    return "";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $debitLedgers = ChartAccount::query()
            ->where([
                ['operation_area_id', '=', auth()->user()->operation_area],
                ['level', '=', 2],
            ])
            ->get();
        $creditLedgers = $debitLedgers;
        return view('admin.accounting.journal-entries', [
            'debitLedgers' => $debitLedgers,
            'creditLedgers' => $creditLedgers
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param ValidateJournalEntryRequest $request
     * @return JsonResponse
     */
    public
    function store(ValidateJournalEntryRequest $request)
    {
        $data = $request->validated();
        $data['operation_area_id'] = auth()->user()->operation_area;
        $data['user_id'] = auth()->user()->id;
        $id = $request->input('id');

        if ($id) {
            $journalEntry = JournalEntry::query()->findOrFail($id);
            $journalEntry->update($data);
        } else {
            $journalEntry = JournalEntry::query()->create($data);
        }

        if ($journalEntry) {
            return response()->json([
                'success' => true,
                'message' => 'Journal Entry saved successfully',
                'data' => $journalEntry
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Journal Entry could not be saved',
            'data' => $journalEntry
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param JournalEntry $journalEntry
     * @return JournalEntry
     */
    public
    function show(JournalEntry $journalEntry)
    {
        return $journalEntry;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param JournalEntry $journalEntry
     * @return JsonResponse
     */
    public
    function destroy(JournalEntry $journalEntry)
    {
        $journalEntry->delete();
        return response()->json([
            'success' => true,
            'message' => 'Journal Entry deleted successfully',
            'data' => $journalEntry
        ]);
    }
}
