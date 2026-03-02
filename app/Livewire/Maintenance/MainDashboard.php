<?php

namespace App\Livewire\Maintenance;


use App\Models\MaintRequest;
use App\Models\MaintTechnician;
use App\Models\MaintSchedule;
use App\Models\MaintAsset;
use App\Models\MaintHistories;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Carbon;

#[Title('Maintenance | Dashboard')]
class MainDashboard extends Component
{
    public $requests_today, $technicians, $total_asset, $total_technicians, $total_requests, $total_schedule, $overdue_schedules, $completed_schedules, $upcoming_schedules, $open_requests, $high_priority, $in_progress_requests, $decommissioned_assets, $under_maintenance_assets, $active_assets;

    public function mount()
    {
        
        // Fetch all technicians with name and phone
        $this->technicians = MaintTechnician::select('name', 'phone')->orderBy('name')->limit(6)->get();
      
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();

        // Total Requests
        $this->total_requests = MaintRequest::count();
        
        // Total Schedule 
        $this->total_schedule  = MaintSchedule::count();
        
        // Total Assets 
        $this->total_asset  = MaintAsset::count();
        
        // Total technicians 
        $this->total_technicians  = MaintTechnician::count();

        // Today's Requests
        $this->requests_today = MaintRequest::whereDate('created_at', $today)->count();

        // Open Requests
        $this->open_requests = MaintRequest::where('status', 'Open')->count();
        
        // High priority
        $this->high_priority = MaintRequest::where('priority', 'High')->count();


        // Overdue schedules (not completed and past due)
        $this->overdue_schedules = MaintSchedule::where('status', '!=', 'Completed')
            ->whereDate('next_scheduled_date', '<', $today)->count();
            
         // Upcoming schedules (future)
        $this->upcoming_schedules = MaintSchedule::whereDate('next_scheduled_date', '>', $today)->count();

          // Completed schedules
        $this->completed_schedules = MaintSchedule::where('status', 'Completed')->count();
        
        
        // In Progress Requests
        $this->in_progress_requests = MaintRequest::where('status', 'In Progress')->count();


        $this->active_assets = MaintAsset::where('status', 'Operational')->count();

        $this->under_maintenance_assets = MaintAsset::where('status', 'Under Maintenance')->count();

        $this->decommissioned_assets = MaintAsset::where('status', 'Decommissioned')->count();
   
    }

    public function render()
    {
        return view('livewire.maintenance.main-dashboard', [
            'requests_today' => $this->requests_today,
            'total_requests' => $this->total_requests,
            'overdue_schedules' => $this->overdue_schedules,
            'open_requests' => $this->open_requests,
            'technicians' => $this->technicians,
            'total_asset' => $this->total_asset,
            'active_assets' => $this->active_assets,
            'under_maintenance_assets' => $this->under_maintenance_assets,
            'decommissioned_assets' => $this->decommissioned_assets,
            'total_technicians' => $this->total_technicians,
            'upcoming_schedules' => $this->upcoming_schedules,
            'completed_schedules' => $this->completed_schedules,
            'high_priority' => $this->high_priority,
            'in_progress_requests' => $this->in_progress_requests,
        ])->layout('layouts.maintenance');
    }
}
