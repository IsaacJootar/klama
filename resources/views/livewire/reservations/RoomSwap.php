<?php

namespace App\Livewire\Reservations;

use Carbon\Carbon;
use App\Models\Room;
use Livewire\Component;
use App\Models\Reservation;
use App\Models\Roomcategory;
use App\Models\Roomallocation;
use App\Models\RoomSwapping;
use Livewire\Attributes\Title;
#[Title('Reservations | Swaps Room(s)')]
class RoomSwap extends Component
{
 public $checkin;
public $checkout;

public $rooms;
public $categories;
public $swaps;
public $room_swap;
public $swap_to;
public $room_id;
public $category_id;
public $reservation_id;
public $customer;



    public function mount() {

        $this->checkin=Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
        $this->checkout=Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d'); //working with dates sucks

        $this->swaps  = Reservation::whereYear('created_at', Carbon::now()->year)
                             ->where('payment_status', '!=', 'Checkedout')
                             ->distinct('reservation_id')->get();

        $this->rooms= Room::query()->orderBy("id","desc")->get();
        $this->categories= Roomcategory::orderBy("id","desc")->get();

        return view('livewire.reservations.room-swap', [
            'swaps' => $this->swaps,
            'rooms'=> $this->rooms,
            'categories'=> $this->categories,
            'checkin'=>$this->checkin,
            'checkout'=>$this->checkout,
          ])->layout('layouts.reservations');
        }


        public function swap($id){


        $this->room_swap = Reservation::findOrFail($id);

        $this->reservation_id = $this->room_swap->reservation_id;
        $this->room_id = $this->room_swap->room_id;
        $this->customer = $this->room_swap->fullname;
        $this->category_id = $this->room_swap->category_id;

    }




        public function save(){// for front desk


            //send a mail here too
            toastr()->info('Room Swap Was Successful');
            //return to_route ('room-swap');


        }
    public function render()
    {
        return view('livewire.reservations.room-swap')->layout('layouts.reservations');

    }
}
