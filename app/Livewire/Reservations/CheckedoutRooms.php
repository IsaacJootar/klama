<?php

namespace App\Livewire\Reservations;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Reservation;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
<<<<<<< HEAD

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
=======
#[Title('Reservations | Checkedout Rooms')]
class CheckedoutRooms extends Component
{

    public $reservations;


    public $due_today;

    public function mount() {
        // for due rooms in the past-forgoten - notification should have handled this, atleast a reminder, maybe later
        $this->due_today = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
           $this->reservations = Reservation::whereDate('checkout', '<=', $this->due_today )
            ->Where('payment_status', '=',  'Checkedout') //  checked out
            ->orderBy("id","desc")->get();
            return view('livewire.reservations.checkedout-rooms', [
                'reservations' => $this->reservations,
            ])->layout('layouts.reservations');




        }

            // Event Handler for re-rendering checked out rooms view
        #[On('refresh-filter-checkedout-rooms')]
        public function refreshFilterDueRooms($search_due1, $search_due2 ){
            //dd($this->reservations = $search_due);
            $this->reservations = Reservation::whereBetween('checkout', [$search_due1, $search_due2])
            ->Where('payment_status', '=',  'Checkedout') // already checked out
            ->orderBy("id","desc")->get();



        }



>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa

    public function render()
    {
        return view('livewire.reservations.checkedout-rooms')->layout('layouts.reservations');
    }
<<<<<<< HEAD
}
=======









}





>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
