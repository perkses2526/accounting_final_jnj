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

    public function update_tickets_status(Request $request)
    {
        $validated = $request->validate([
            'ticket_ids' => 'required|array', // Ensure this is set to required
            'ticket_ids.*' => 'exists:tickets,id', // Check that each ID exists in the tickets table
            'status' => 'required|string|max:25',
            'reason_if_denied' => 'nullable|string|max:255', // Make this optional
        ]);

        // Process the ticket updates
        $tickets = Tickets::whereIn('id', $validated['ticket_ids']); // Fetch tickets to update

        // Prepare additional fields for update
        $updateData = [
            'status' => $validated['status'], // Get the status from validated data
            'reason_if_denied' => $validated['reason_if_denied'], // Reason if denied
            'date_status_updated' => now(), // Current timestamp
            'approved_by' => auth()->user()->id, // Use auth() to get the currently authenticated user
        ];

        try {
            // Update the tickets with the filtered data
            $tickets->update($updateData);

            // Return a success response
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            // Return an error response in case of failure
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }




    public function multiple_updates()
    {
        $userId = auth()->id();

        $tickets = DB::table('tickets as t')
            ->select(
                't.id',
                't.user_code',
                't.date_entered',
                'tl.transaction_name',
                't.reference_no',
                't.remarks',
                't.expiry_date_time',
                DB::raw("IF(t.status IS NULL AND (t.expiry_date_time IS NULL OR t.expiry_date_time > NOW()), '<span class=\"text-warning\">Pending</span>', 
                IF(t.expiry_date_time IS NOT NULL AND t.expiry_date_time <= NOW(), '<span class=\"text-red-600\">Expired</span>', 
                IF(t.status = 'Approved', '<span class=\"text-green-600\">Approved</span>', 
                CONCAT('<span class=\"text-red-600\">', t.status, '</span>')) 
            )) AS status"),
                DB::raw("CONCAT('<button class=\"btn btn-sm m-1 btn-info view-ticket-details\" data-ticket-id=\"', t.id, '\" >View details</button>') AS action")
            )
            ->leftJoin('transaction_lists as tl', 'tl.id', '=', 't.transaction_id')
            ->join('transaction_permissions as tp', 'tp.transaction_id', '=', 't.transaction_id') // Join with transaction_permissions
            ->where('tp.user_id', '=', $userId) // Filter based on the current user's assigned transactions
            ->whereNull('t.status') // Ensure status is NULL (Pending)
            ->where(function ($query) {
                $query->whereNull('t.expiry_date_time') // Not expired: No expiry date
                    ->orWhere('t.expiry_date_time', '>', now()); // Not expired: Expiry date is in the future
            })
            ->get();

        return response()->json(['data' => $tickets]); // Ensure correct JSON response
    }

    public function statusList($status)
    {
        // Get the currently authenticated user's ID
        $userId = auth()->id();

        $tickets = DB::table('tickets as t')
            ->select(
                't.id',
                't.user_code',
                't.date_entered',
                'tl.transaction_name',
                't.reference_no',
                't.remarks',
                't.expiry_date_time',
                DB::raw("IF(t.status IS NULL AND (t.expiry_date_time IS NULL OR t.expiry_date_time > NOW()), '<span class=\"text-warning\">Pending</span>', 
                IF(t.expiry_date_time IS NOT NULL AND t.expiry_date_time <= NOW(), '<span class=\"text-red-600\">Expired</span>', 
                IF(t.status = 'Approved', '<span class=\"text-green-600\">Approved</span>', 
                CONCAT('<span class=\"text-red-600\">', t.status, '</span>')) 
            )) AS status"),
                DB::raw("CONCAT('<button class=\"btn btn-sm m-1 btn-info view-ticket-details\" data-ticket-id=\"', t.id, '\" >View details</button>') AS action")
            )
            ->leftJoin('transaction_lists as tl', 'tl.id', '=', 't.transaction_id')
            ->join('transaction_permissions as tp', 'tp.transaction_id', '=', 't.transaction_id') // Join with transaction_permissions
            ->where('tp.user_id', '=', $userId) // Filter based on the current user's assigned transactions
            ->where(function ($query) use ($status) {
                // Adjust the logic to filter by status
                if ($status === 'Pending') {
                    $query->whereNull('t.status')
                        ->where(function ($query) {
                            $query->whereNull('t.expiry_date_time')
                                ->orWhere('t.expiry_date_time', '>', now());
                        });
                } elseif ($status === 'Expired') {
                    $query->whereNotNull('t.expiry_date_time')
                        ->where('t.expiry_date_time', '<=', now());
                } else {
                    $query->where('t.status', $status);
                }
            })
            ->get();

        return response()->json(['data' => $tickets]); // Ensure correct JSON response
    }

    public function get_data()
    {
        // Get the currently authenticated user's ID
        $userId = auth()->id();

        $tickets = DB::table('tickets as t')
            ->select(
                't.id',
                't.user_code',
                't.date_entered',
                'tl.transaction_name',
                't.reference_no',
                't.remarks',
                't.expiry_date_time',
                DB::raw("IF(t.status IS NULL AND (t.expiry_date_time IS NULL OR t.expiry_date_time > NOW()), '<span class=\"text-warning\">Pending</span>', 
                IF(t.expiry_date_time IS NOT NULL AND t.expiry_date_time <= NOW(), '<span class=\"text-red-600\">Expired</span>', 
                IF(t.status = 'Approved', '<span class=\"text-green-600\">Approved</span>', 
                CONCAT('<span class=\"text-red-600\">', t.status, '</span>')) 
            )) AS status"),
                DB::raw("CONCAT('<button class=\"btn btn-sm m-1 btn-info view-ticket-details\" data-ticket-id=\"', t.id, '\" >View details</button>') AS action")
            )
            ->leftJoin('transaction_lists as tl', 'tl.id', '=', 't.transaction_id')
            ->join('transaction_permissions as tp', 'tp.transaction_id', '=', 't.transaction_id') // Join with transaction_permissions
            ->where('tp.user_id', '=', $userId) // Filter based on the current user's assigned transactions
            ->get();


        return response()->json(['data' => $tickets]); // Ensure correct JSON response
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
        // Fetch the ticket data along with the transaction name from the join table
        $ticketsData = DB::table('tickets as t')
            ->select('*') // Get all columns from both tables
            ->leftJoin('transaction_lists as tl', 'tl.id', '=', 't.transaction_id')
            ->where('t.id', $tickets->id) // Filter by the specific ticket ID
            ->first(); // Get the single result instead of a collection

        // Check if the ticket exists
        if (!$ticketsData) {
            abort(404, 'Ticket not found'); // Handle not found scenario
        }

        // Pass the fetched ticket data to the view
        return view('tickets_list.show', compact('tickets'));
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
        // Validate the incoming request data
        $validated = $request->validate([
            'status' => 'required|string|max:25',
            'reason_if_denied' => 'nullable|string|max:255', // Making this field optional
        ]);

        // Add additional fields manually
        $validated['date_status_updated'] = now();
        $validated['approved_by'] = auth()->user()->id; // Use auth() to get the currently authenticated user

        try {
            // Update the tickets with the validated data
            $tickets->update($validated);

            // Return a success response
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            // Return an error response in case of failure
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tickets $tickets)
    {
        //
    }
}
