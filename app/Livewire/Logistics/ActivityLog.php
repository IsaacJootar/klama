<?php

namespace App\Livewire\Logistics;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Report;
use App\Models\Fleet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

#[Title('Logistics | Activity Log')]
class ActivityLog extends Component
{
    public $total_reports = 0;
    public $total_fleet_items = 0;
    public $total_trips_made = 0;
    public $total_breakdowns = 0;
    public $total_airport_pickups = 0;
    public $fleet_categories = [];
    public $trips_trends = [];

    public function mount()
    {
        try {
            // Total reports
            $this->total_reports = Report::where('section', 'Logistics')->count();
            //Log::info('Total reports count: ' . $this->total_reports);

            // Total fleet items
            $this->total_fleet_items = Fleet::count();
            //Log::info('Total fleet items count: ' . $this->total_fleet_items);

            // Total trips made
            $this->total_trips_made = Report::where('section', 'Logistics')->sum('trips_made');
            //Log::info('Total trips made: ' . $this->total_trips_made);

            // Total breakdowns
            $this->total_breakdowns = Report::where('section', 'Logistics')->sum('breakdowns');
            //Log::info('Total breakdowns: ' . $this->total_breakdowns);

            // Total airport pickups
            $this->total_airport_pickups = Report::where('section', 'Logistics')->sum('airport_pickups');
            //Log::info('Total airport pickups: ' . $this->total_airport_pickups);

            // Fleet categories (group by category)
            $this->fleet_categories = Fleet::groupBy('category')
                ->selectRaw('category, COUNT(*) as count')
                ->pluck('count', 'category')
                ->toArray();
            //Log::info('Fleet categories: ' . json_encode($this->fleet_categories));

            // Trips trends (last 7 days)
            $this->trips_trends = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::today()->subDays($i)->format('Y-m-d');
                $trips = Report::where('section', 'Logistics')
                    ->whereDate('date', $date)
                    ->sum('trips_made');
                $this->trips_trends[] = [
                    'date' => $date,
                    'trips' => $trips,
                ];
            }
            Log::info('Trips trends data: ' . json_encode($this->trips_trends));
        } catch (\Exception $e) {
            //Log::error('Error fetching logistics data: ' . $e->getMessage());
            // Set default values to prevent undefined errors
            $this->total_reports = 0;
            $this->total_fleet_items = 0;
            $this->total_trips_made = 0;
            $this->total_breakdowns = 0;
            $this->total_airport_pickups = 0;
            $this->fleet_categories = [];
            $this->trips_trends = [];
        }
    }

    public function render()
    {
        return view('livewire.logistics.activity-log')->layout('layouts.logistics', [
            'total_reports' => $this->total_reports,
            'total_fleet_items' => $this->total_fleet_items,
            'total_trips_made' => $this->total_trips_made,
            'total_breakdowns' => $this->total_breakdowns,
            'total_airport_pickups' => $this->total_airport_pickups,
            'fleet_categories' => $this->fleet_categories,
            'trips_trends' => $this->trips_trends,
        ]);
    }
}
