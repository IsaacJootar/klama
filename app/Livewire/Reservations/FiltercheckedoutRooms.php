<?php

namespace App\Livewire\Reservations;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Reservation;
use Livewire\Attributes\Title;

#[Title('Reservations | Filter CheckedOut Rooms')]
class FiltercheckedoutRooms extends Component
{
    public $reservations;
    public $due_period;

    public function due()
    {
        $today = Carbon::today()->timezone('Africa/Lagos')->format('Y-m-d');
        $periods = [
            'today' => 'Today',
            'yesterday' => 'Yesterday',
            'week' => 'Last Week',
            'month' => 'Last Month',
            'year' => 'Last Year',
            'all' => 'All Time',
        ];
        $period = $periods[$this->due_period] ?? 'Today';

        switch ($this->due_period) {
            case 'today':
                $this->reservations = Reservation::whereDate('updated_at', $today)
                    ->where('checkout_status', '=', 'Checkedout')
                    ->orderBy('id', 'desc')->get();
                $this->dispatch('refresh-filter-checkedout-rooms', $today, $today, $period);
                break;

            case 'yesterday':
                $yesterday = Carbon::yesterday()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereDate('updated_at', $yesterday)
                    ->where('checkout_status', '=', 'Checkedout')
                    ->orderBy('id', 'desc')->get();
                $this->dispatch('refresh-filter-checkedout-rooms', $yesterday, $yesterday, $period);
                break;

            case 'week':
                $start = Carbon::today()->subDays(7)->startOfDay()->timezone('Africa/Lagos')->format('Y-m-d');
                $end = $today;
                $this->reservations = Reservation::whereBetween('checkout', [$start, $end])
                    ->where('checkout_status', '=', 'Checkedout')
                    ->orderBy('id', 'desc')->get();
                $this->dispatch('refresh-filter-checkedout-rooms', $start, $end, $period);
                break;

            case 'month':
                $start = Carbon::today()->subMonth()->startOfMonth()->timezone('Africa/Lagos')->format('Y-m-d');
                $end = Carbon::today()->subMonth()->endOfMonth()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [$start, $end])
                    ->where('checkout_status', '=', 'Checkedout')
                    ->orderBy('id', 'desc')->get();
                $this->dispatch('refresh-filter-checkedout-rooms', $start, $end, $period);
                break;

            case 'year':
                $start = Carbon::today()->subYear()->startOfYear()->timezone('Africa/Lagos')->format('Y-m-d');
                $end = Carbon::today()->subYear()->endOfYear()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [$start, $end])
                    ->where('checkout_status', '=', 'Checkedout')
                    ->orderBy('id', 'desc')->get();
                $this->dispatch('refresh-filter-checkedout-rooms', $start, $end, $period);
                break;

            case 'all':
                $this->reservations = Reservation::where('checkout_status', '=', 'Checkedout')
                    ->orderBy('id', 'desc')->get();
                $start = Carbon::today()->subYears(5)->startOfYear()->timezone('Africa/Lagos')->format('Y-m-d');
                $end = $today;
                $this->reservations = Reservation::where('checkout_status', '=', 'Checkedout')
                    ->orderBy('id', 'desc')->get();
                $this->dispatch('refresh-filter-checkedout-rooms', $start, $end, $period);
                break;

            default:
                $this->reservations = Reservation::whereDate('updated_at', $today)
                    ->where('checkout_status', '=', 'Checkedout')
                    ->orderBy('id', 'desc')->get();
                $this->dispatch('refresh-filter-checkedout-rooms', $today, $today, $period);
                break;
        }

        toastr()->info('Search is complete');
        $this->reset('due_period');
    }

    public function exit()
    {
        $this->reset('due_period');
    }

    public function render()
    {
        return view('livewire.reservations.filtercheckedout-rooms');
    }
}
