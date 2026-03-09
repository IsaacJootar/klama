<?php

namespace App\Livewire\Reservations;

use Carbon\Carbon;
use App\Models\Room;
use Livewire\Component;
<<<<<<< HEAD
use App\Models\SwapRoom;
use App\Models\Reservation;
use App\Models\Roomcategory;
use App\Models\Roomallocation;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
#[Title('Reservations | Swap Room(s)')]
class RoomSwap extends Component
{
    public $swaps;


=======
use App\Models\Reservation;
use App\Models\Roomcategory;
use App\Models\Roomallocation;
use App\Models\RoomSwapping;
use Livewire\Attributes\Title;
#[Title('Reservations | Swap Room(s)')]
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
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa



    public function mount() {

<<<<<<< HEAD
       $this->swaps = SwapRoom::whereBetween('created_at', [
            Carbon::now()->startOfMonth(), // First day of the current month
            Carbon::now()->endOfMonth()    // Last day of the current month
        ])->get();



        return view('livewire.reservations.room-swap', [
            'swaps' => $this->swaps,
=======
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
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
          ])->layout('layouts.reservations');
        }


<<<<<<< HEAD



      

=======
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
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
    public function render()
    {
        return view('livewire.reservations.room-swap')->layout('layouts.reservations');

    }
}
