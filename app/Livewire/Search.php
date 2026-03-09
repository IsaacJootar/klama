<?php
<<<<<<< HEAD

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Roomallocation;

#[Title('Online Booking | Room Search')]
class Search extends Component
{
    public $allocations;
    public $checkin = '';
    public $checkout = '';
    public $category_id;
    public $nor = '';

    public function mount()
    {
        $this->checkin = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
        $this->checkout = Carbon::now()->timezone('Africa/Lagos')->addDays(1)->format('Y-m-d');
        $this->allocations = Roomallocation::with('category')
            ->where(function ($query) {
                $query->where('status', 'Available')
                      ->whereDate('checkin', '>', $this->checkin)
                      ->whereDate('checkout', '>', $this->checkout);
            })
            ->orWhere('checkin', '=', '1986-09-01') // Default case
            ->orderBy("id", "desc")
            ->distinct('category_id')
            ->get();
    }

    public function search()
    {
        $checkin = Carbon::parse($this->checkin)->toDateString();
        $checkout = Carbon::parse($this->checkout)->toDateString();
        $today = now()->toDateString();

        if ($checkin < $today || $checkout < $today) {
            toastr()->warning('Search Dates Cannot include past dates!');
            return; // Important: Exit here to prevent further processing
        }

        $this->allocations = Roomallocation::with('category')
            ->where('status', 'Available')
            ->whereNotBetween('checkin', [$this->checkin, $this->checkout])
            ->whereNotBetween('checkout', [$this->checkin, $this->checkout])
            ->orderBy("id", "desc")
            ->distinct('category_id')
            ->get();

        session()->put('checkin', $this->checkin);
        session()->put('checkout', $this->checkout);
        session()->put('token', 2);

        $this->dispatch('refresh-room-allocations', $this->checkin, $this->checkout);
        // toastr()->info('search completed');
         // ✅ Add browser event to reinitialize JS like Swiper
  $this->dispatch('contentChanged');

    }

    public function render()
    {
        return view('livewire.search')
            ->layout('layouts.frontend');
    }
}
=======
namespace App\Livewire;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Roomallocation;
use Livewire\Attributes\Title;


#[Title('Online Booking | Room Search')]

class Search extends Component
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
                    ->where('status', 'Available')
                    ->whereDate('checkin','>',  $this->checkin)
                    ->whereDate('checkout','>', $this->checkout)
                    ->orWhere('checkin', '=',  '1986-09-01') // my weird date, picked from the past (default)
                    ->orderBy("id","desc")->distinct()->get('category_id');


    }

public function search(){
   
    //search parameters should not be in the past,or the ones already reserved for today and tomorrow
    $checkin = Carbon::parse($this->checkin)->toDateString();
    $checkout = Carbon::parse($this->checkout)->toDateString();
    $today = now()->toDateString();

if ($checkin < $today || $checkout < $today) {
    toastr()->warning('Search Dates Cannot include past dates!');
    return view('livewire.room-search');
}


    $this->allocations= Roomallocation::with('category')
    ->where('status', 'Available')
    ->whereNotBetween('checkin', [$this->checkin, $this->checkout])
    ->whereNotBetween('checkout', [$this->checkin, $this->checkout] )
    ->orderBy("id","desc")->distinct()->get('category_id');

            session()->put('checkin', $this->checkin );
            session()->put('checkout', $this->checkout);
            session()->put('token', 2);

            $this->dispatch('refresh-room-allocations', $this->checkin, $this->checkout);
            // toastr()->info('search completed')


}




    public function render()
    {

        return view('livewire.search')
        ->layout('layouts.frontend');
    }





}
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
