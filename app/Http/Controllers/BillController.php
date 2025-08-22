<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function show(Bill $bill)
    {
        // Load relationships
        $bill->load(['comments.user']);

        return view('bills.show', compact('bill'));
    }

}

