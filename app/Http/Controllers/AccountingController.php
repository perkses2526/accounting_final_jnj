<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountingController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin')) {
            return view('accounting.index');
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function get_account_data($company_code, $division_code, $department_code)
    {
        $accountData = DB::table('accounting_data as a')
            ->join('transaction_lists as t', 't.id', '=', 'a.source') // Correctly using 'a.source' as the join condition
            ->where('a.company_code', $company_code)
            ->where('a.division_code', $division_code)
            ->where('a.department_code', $department_code)
            ->select('a.*', 't.transaction_name') // Select fields from both tables as needed
            ->get();

        return response()->json($accountData);
    }




    public function get_div_data($companyCode)
    {
        // Query the accounting_data table to get unique division codes for the selected company
        $div_data = DB::table('accounting_data')
            ->select(
                'division_code as id',
                'division_code as name'
            )
            ->where('company_code', $companyCode)
            ->distinct() // Get distinct division codes
            ->get();

        return response()->json($div_data); // Return JSON response
    }
    public function get_dept_data($divisionCode)
    {
        // Query the accounting_data table to get unique department codes for the selected division
        $dept_data = DB::table('accounting_data')
            ->select(
                'department_code as id',
                'department_code as name'
            )
            ->where('division_code', $divisionCode)
            ->distinct() // Get distinct department codes
            ->get();

        return response()->json($dept_data); // Return JSON response
    }
}
