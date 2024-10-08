<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use App\Models\TransactionList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tickets_list.index');
    }

    public function transaction_list()
    {
        $transaction_list = DB::table('transaction_lists as t')
            ->select(
                't.id',
                't.transaction_name'
            )
            ->orderBy('t.created_at', 'asc')
            ->get();

        return view('tickets_list.transaction_list', compact('transaction_list'));
    }

    public function get_transaction_list_data()
    {
        $transaction_list = DB::table('transaction_lists as t')
            ->select(
                't.id',
                't.transaction_name as name'
            )
            ->orderBy('t.created_at', 'asc')
            ->get();

        return response()->json($transaction_list);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tickets_list.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_code' => 'required|string|max:255',
            'date_entered' => 'required|date',
            'transaction_id' => 'required|integer|exists:transaction_lists,id',
            'reference_no' => 'required|string|max:255',
            'remarks' => 'nullable|string',
            'expiry_date_time' => 'nullable|date',
        ]);

        try {
            // If validation passes, create the new Ticket entry
            Tickets::create([
                'user_code' => $validated['user_code'],
                'date_entered' => $validated['date_entered'],
                'transaction_id' => $validated['transaction_id'],
                'reference_no' => $validated['reference_no'],
                'remarks' => $validated['remarks'],
                'expiry_date_time' => $validated['expiry_date_time'],
                'guard_name' => 'web',
            ]);

            return response()->json(['success' => 'Ticket added successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error adding ticket: ' . $e->getMessage()], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Tickets $tickets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tickets $tickets)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tickets $tickets)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tickets $tickets)
    {
        //
    }
}
