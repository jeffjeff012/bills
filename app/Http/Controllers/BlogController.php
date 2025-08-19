<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;

class BlogController extends Controller
{
   public function show($bill_id)
    {
        $bill = Bill::findOrFail($bill_id);
        $bill->loadCount('comments');
        return view('bill', compact('bill'));
    }


    public function showInactive(Bill $bill)
    {
        $bill->load(['comments.user']);
        return view('inactive-blog', compact('bill'));
    }

}
