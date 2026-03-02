<?php

namespace App\Livewire\Housekeeping;

use Livewire\Component;
use App\Models\HouseLaundryRequest;
use App\Models\HouseCleaningSchedule;
use App\Models\HouseHousekeepingTask;
use App\Models\HouseRoomStatus;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;

#[Title('Housekeeping | Dashboard')]
class HouseDashboard extends Component
{
    // Primary Metrics
    public $clean_rooms;
    public $dirty_rooms;
    public $pending_laundry_requests;
    public $active_tasks;

    // Secondary Metrics
    public $scheduled_cleanings_today;
    public $completed_tasks_today;
    public $under_maintenance_rooms;
    public $assigned_staff;

    // Chart Data
    public $cleaning_trends;
    public $laundry_trends;

    public function mount()
    {
        $this->loadPrimaryMetrics();
        $this->loadSecondaryMetrics();
        $this->loadChartData();
    }

    private function loadPrimaryMetrics()
    {
        $today = Carbon::today()->timezone('Africa/Lagos');

        $this->clean_rooms = HouseRoomStatus::where('status', 'Clean')->count();
        $this->dirty_rooms = HouseRoomStatus::where('status', 'Dirty')->count();
        $this->pending_laundry_requests = HouseLaundryRequest::where('status', 'Received')->count();
        $this->active_tasks = HouseHousekeepingTask::whereIn('task_status', ['Pending', 'In Progress'])->count();
    }

    private function loadSecondaryMetrics()
    {
        $today = Carbon::today()->timezone('Africa/Lagos');

        $this->scheduled_cleanings_today = HouseCleaningSchedule::whereDate('cleaning_date', $today)
            ->where('status', 'Scheduled')->count();
        $this->completed_tasks_today = HouseHousekeepingTask::whereDate('completed_date', $today)
            ->where('task_status', 'Completed')->count();
        $this->under_maintenance_rooms = HouseRoomStatus::where('status', 'Under Maintenance')->count();
        $this->assigned_staff = HouseCleaningSchedule::whereDate('cleaning_date', $today)
            ->distinct('user_id')->count('user_id');
    }

    private function loadChartData()
    {
        $this->cleaning_trends = collect(range(6, 0))->map(function ($daysAgo) {
            $date = Carbon::today()->timezone('Africa/Lagos')->subDays($daysAgo);
            return [
                'date' => $date->format('M d'),
                'cleanings' => HouseCleaningSchedule::whereDate('cleaning_date', $date)
                    ->where('status', 'Completed')->count(),
            ];
        });

        $this->laundry_trends = collect(range(6, 0))->map(function ($daysAgo) {
            $date = Carbon::today()->timezone('Africa/Lagos')->subDays($daysAgo);
            return [
                'date' => $date->format('M d'),
                'requests' => HouseLaundryRequest::whereDate('requested_at', $date)->count(),
            ];
        });
    }

    public function render()
    {
        return view('livewire.housekeeping.house-dashboard', [
            'clean_rooms' => $this->clean_rooms,
            'dirty_rooms' => $this->dirty_rooms,
            'pending_laundry_requests' => $this->pending_laundry_requests,
            'active_tasks' => $this->active_tasks,
            'scheduled_cleanings_today' => $this->scheduled_cleanings_today,
            'completed_tasks_today' => $this->completed_tasks_today,
            'under_maintenance_rooms' => $this->under_maintenance_rooms,
            'assigned_staff' => $this->assigned_staff,
            'cleaning_trends' => $this->cleaning_trends,
            'laundry_trends' => $this->laundry_trends,
        ])->layout('layouts.housekeeping');
    }
}