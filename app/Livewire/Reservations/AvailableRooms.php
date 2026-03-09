<?php

namespace App\Livewire\Reservations;

use Carbon\Carbon;
use App\Models\Room;
use Livewire\Component;
use App\Models\Roomcategory;
use App\Models\Roomallocation;
use Livewire\Attributes\Title;

#[Title('Reservations | Available Rooms')]
class AvailableRooms extends Component
{
    public $checkin;
    public $checkout;

    public $rooms;
    public $categories;
    public $availables;
    public function mount()
    {

        $this->checkin = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
        $this->checkout = Carbon::now()->timezone('Africa/Lagos')->addDays(1)->format('Y-m-d'); //working with dates sucks
        
 $this->availables = Roomallocation::with('category')
    ->where(function ($query) {
        $query->whereDate('checkin', '>', $this->checkin)
              ->whereDate('checkout', '>', $this->checkout)
              ->orWhere('checkin', '=', '1986-09-01');
    })
    ->where('status', 'Available')
    ->orderBy('id', 'desc')
    ->get();

        $this->rooms = Room::query()->orderBy("id", "desc")->get();
        $this->categories = Roomcategory::query()->orderBy("id", "desc")->get();

        //format date and pass to view
        $this->checkin = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
        $this->checkout = Carbon::now()->addDays(1)->timezone('Africa/Lagos')->format('Y-m-d');
        return view('livewire.reservations.available-rooms', [
            'availables' => $this->availables,
            'rooms' => $this->rooms,
            'categories' => $this->categories,
            'checkin' => $this->checkin,
            'checkout' => $this->checkout,
        ])->layout('layouts.reservations');
    }






    public function render()
    {
        return view('livewire.reservations.available-rooms')->layout('layouts.reservations');
    }
}
