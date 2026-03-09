<?php

namespace App\Livewire\Reservations;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Reservation;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;

#[Title('Reservations | Checkedout Rooms')]
class CheckedoutRooms extends Component
{
    public $reservations;
    public $due_today;
    public $search_period = 'All Time';
    public $show_customer_list = false;

    public function mount()
    {
        $this->due_today = Carbon::today()->timezone('Africa/Lagos')->format('Y-m-d');
        $this->reservations = Reservation::where('checkout_status', '=', 'Checkedout')
            ->orderBy('id', 'desc')->get();
        return view('livewire.reservations.checkedout-rooms', [
            'reservations' => $this->reservations,
            'search_period' => $this->search_period,
        ])->layout('layouts.reservations');
    }

    #[On('refresh-filter-checkedout-rooms')]
    public function refreshFilterDueRooms($search_due1, $search_due2, $period)
    {
        $this->reservations = Reservation::whereBetween('updated_at', [$search_due1 . ' 00:00:00', $search_due2 . ' 23:59:59'])
            ->where('checkout_status', '=', 'Checkedout')
            ->orderBy('id', 'desc')->get();
        $this->search_period = $period;
        $this->show_customer_list = false; // Reset list visibility on new search
    }

    public function toggleCustomerList()
    {
        $this->show_customer_list = !$this->show_customer_list;
    }

    public function render()
    {
        return view('livewire.reservations.checkedout-rooms')->layout('layouts.reservations');
    }
}