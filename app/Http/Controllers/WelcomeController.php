<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index()
    {
        // --- Active Bills Only ---
        $activeBillsQuery = Bill::where(function ($query) {
            $query->whereNull('due_date')
                  ->orWhereDate('due_date', '>=', Carbon::today());
        });

        // Get the bill with the most likes (Hot Bill)
        $hotBill = (clone $activeBillsQuery)
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->first();

        // Get the bill with the most comments (Most Commented Bill)
        $mostCommentedBill = (clone $activeBillsQuery)
            ->withCount('comments')
            ->orderByDesc('comments_count')
            ->first();

        
        // If both are the same bill, merge them
        $combinedBill = null;
        if (
            $hotBill &&
            $mostCommentedBill &&
            $hotBill->id === $mostCommentedBill->id
        ) {
            $candidate = Bill::withCount(['likes', 'comments'])->find($hotBill->id);

            if ($candidate->likes_count > 0 && $candidate->comments_count > 0) {
                $combinedBill = $candidate;
            }
        }


        // Basic stats
        $totalBills = Bill::count();
        $totalComments = Comment::count(); 
        $totalVotes = Like::count();   

        // --- User Engagement Calculation ---
        $totalUsers = User::count();

        // Assign weights to actions
        $weightedScore = ($totalComments * 3) + ($totalVotes * 2);

        // Optional: include page views if you track them
        // $pageViews = DB::table('page_views')->count();
        // $weightedScore += ($pageViews * 1);

        // Define max possible score (e.g., assume max 10 weighted actions per user)
        $maxScorePerUser = 10 * 3; // adjust if needed based on your weights
        $maxScore = $totalUsers * $maxScorePerUser;

        // Compute engagement %
        $userEngagement = $maxScore ? ($weightedScore / $maxScore) * 100 : 0;

        // Other bills (exclude the most commented one, still filter active only)
        $otherBills = (clone $activeBillsQuery)
            ->withCount('comments')
            ->when($mostCommentedBill, fn ($q) => $q->where('id', '!=', $mostCommentedBill->id))
            ->latest()
            ->get();

        // Pass data to the welcome view
        return view('welcome', compact(
            'hotBill',
            'mostCommentedBill',
            'totalBills',
            'totalComments',
            'totalVotes',
            'userEngagement',
            'otherBills',
            'combinedBill'
        ));
    }
}
