<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class ActivityLogs extends Component
{
    use WithPagination;

    public $perPage = 10;

    public function render()
    {
        // Clean up old logs before fetching
        Activity::where('created_at', '<', now()->subDays(30))->delete();

        $logs = Activity::with('causer')
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.admin.activity-logs', [
            'logs' => $logs,
        ]);
    }

}
