<?php
namespace App\Livewire;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Roomallocation;
use Livewire\Attributes\On;
use Carbon\Carbon;


#[Title('Reservations | Room Search')]

class RoomSearch extends Component
{



    public $allocations;
    public $checkin= '';
    public $checkout = '';
    public $category_id;
    public  $nor = '';
    
    
    public function mount(){
                $this->checkin = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->checkout=Carbon::now()->timezone('Africa/Lagos')->addDays(1)->format('Y-m-d');
                $this->allocations= Roomallocation::with('category')
                ->Where('checkin', '=',  '1986-09-02') // my weird date, picked from the past (this date finds no rooms) this will return no rooms,thereby making the search results empty,it  will force customers to select arrrival and departure
                ->orderBy("id","desc")->distinct()->get('category_id');

                    session()->put('checkin', $this->checkin );
                    session()->put('checkout', $this->checkout);
                    session()->put('token', 1);



    }


    #[On('refresh-room-allocations')]
    public function refreshRoomAllocations($checkin, $checkout){  //variables from  dispatch
        $this->allocations= Roomallocation::with('category')
        ->whereNotBetween('checkin', [$checkin, $checkout])
        ->whereNotBetween('checkout', [$checkin, $checkout] )
        ->orderBy("id","desc")->distinct()->get('category_id');
    }





    public function render()
    {
        return view('livewire.room-search')
        ->layout('layouts.frontend');
    }
}
