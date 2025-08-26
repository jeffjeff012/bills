<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReportController extends Controller
{
    public function bills()
    {
        // Check authorization
        if (!Gate::allows('report-of-bills')) {
            abort(403, 'You do not have permission to access this report.');
        }

        return view('reports.bills');
    }
}