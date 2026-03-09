<?php

namespace App\Livewire\Reservations;

use Carbon\Carbon;
use App\Models\Room;
use Livewire\Component;
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





    public function mount() {

       $this->swaps = SwapRoom::whereBetween('created_at', [
            Carbon::now()->startOfMonth(), // First day of the current month
            Carbon::now()->endOfMonth()    // Last day of the current month
        ])->get();



        return view('livewire.reservations.room-swap', [
            'swaps' => $this->swaps,
          ])->layout('layouts.reservations');
        }





      

    public function render()
    {
        return view('livewire.reservations.room-swap')->layout('layouts.reservations');

    }
}
