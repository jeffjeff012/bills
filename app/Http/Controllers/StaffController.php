<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Note;

class StaffController extends Controller
{
    public function dashboard()
    {
        $userCount = Schema::hasTable('users') ? User::count() : 0;
        $noteCount = Schema::hasTable('notes') ? Note::count() : 0;
        $totalLikes = Schema::hasTable('notes') ? Note::sum('likes') : 0;
        $totalDislikes = Schema::hasTable('notes') ? Note::sum('dislikes') : 0;

        return view('staff.dashboard', compact(
            'userCount',
            'noteCount',
            'totalLikes',
            'totalDislikes'
        ));
    }
}
