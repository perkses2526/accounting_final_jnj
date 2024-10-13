<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
