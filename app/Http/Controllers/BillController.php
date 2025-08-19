<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function show()
    {
        $bills = Bill::withCount(['likes', 'comments'])->with('comments.user')->latest()->get();


        return view('bills.show', compact('bills'));
    }

}

