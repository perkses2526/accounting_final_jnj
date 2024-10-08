<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function fetch_numbers()
    {
        $userId = auth()->id();
        // Assuming $userId is the ID of the current user
        $ticketCounts = DB::table('tickets as t')
            ->leftJoin('transaction_lists as tl', 'tl.id', '=', 't.transaction_id')
            ->join('transaction_permissions as tp', 'tp.transaction_id', '=', 't.transaction_id') // Join with transaction_permissions
            ->where('tp.user_id', '=', $userId) // Filter based on the current user's assigned transactions
            ->select(
                DB::raw("COUNT(CASE WHEN t.status IS NULL AND (t.expiry_date_time IS NULL OR t.expiry_date_time > NOW()) THEN 1 END) as pending_count"), // Count Pending
                DB::raw("COUNT(CASE WHEN t.status = 'Approved' THEN 1 END) as approved_count"), // Count Approved
                DB::raw("COUNT(CASE WHEN t.status = 'Denied' THEN 1 END) as denied_count"), // Count Denied
                DB::raw("COUNT(CASE WHEN t.expiry_date_time IS NOT NULL AND t.expiry_date_time <= NOW() THEN 1 END) as expired_count") // Count Expired
            )
            ->first(); // Get the first (and only) result since we are aggregating

        // Convert the counts to an array for easier JSON response
        $responseData = [
            'pending' => $ticketCounts->pending_count,
            'approved' => $ticketCounts->approved_count,
            'denied' => $ticketCounts->denied_count,
            'expired' => $ticketCounts->expired_count,
        ];

        return response()->json(['data' => $responseData]);
    }
}
