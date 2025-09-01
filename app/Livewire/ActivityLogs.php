<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class ActivityLogs extends Component
{
    use WithPagination;

    public $perPage = 10;

    public function mount()
    {
        $user = auth()->user();

        // If not logged in
        if (!$user) {
            abort(403, 'Unauthorized.');
        }

        // Allow only Admins
        if ($user->role !== \App\Enums\UserRole::Admin) {
            abort(403, 'You are not allowed to access this page.');
        }
    }
    
    public function render()
    {
        // Clean up old logs before fetching
        Activity::where('created_at', '<', now()->subDays(30))->delete();

        $logs = Activity::with('causer')
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.activity-logs', [
            'logs' => $logs,
        ]);
    }

}
