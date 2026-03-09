<?php

namespace App\Livewire\Reservations;

use App\Http\Helpers\Helper;
use Livewire\Component;
use App\Models\Reservation;
use App\Models\Roomallocation;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Title('Reservation Form')]
class CreateReservation extends Component
{
    public $category_id;
    public $room_id;
    public $nor;
    public $checkin;
    public $checkout;
    public $medium = 'Front Desk';
    public $fullname;
    public $address;
    public $requests;
    public $payment_status;
    public $phone;
    public $email;
    public $total_amount;

    public $allocations;
    public $allocation;
    public $reservation_id;
   
    public function mount()
    {
        $this->allocations = Roomallocation::with('category')
            ->where('category_id', $this->category_id)
            ->distinct()
            ->get('category_id');

        return view('livewire.reservations.create-reservation')->with([
            'category_id' => $this->category_id,
            'nor' => $this->nor,
            'checkin' => $this->checkin,
            'checkout' => $this->checkout,
            'allocations' => $this->allocations,
        ])->layout('layouts.reservations');
    }

    public function render()
    {
        return view('livewire.reservations.create-reservation')->layout('layouts.reservations');
    }

    // Your original reservation logic
    public function store()
    {
        $this->validate([
            'email' => 'nullable|email:rfc',
            'nor' => ['required'],
            'fullname' => ['required'],
            'phone' => ['required', 'numeric'],
        ], [
            'nor.required' => 'Please select number of room(s).',
            'phone.required' => 'Please Your Contact Number is required.',
            'fullname.required' => 'Please Customer fullname is required.',
        ]);

        $this->allocations = Roomallocation::where('category_id', $this->category_id)
            ->whereNotBetween('checkin', [$this->checkin, $this->checkout])
            ->whereNotBetween('checkout', [$this->checkin, $this->checkout])
            ->limit($this->nor)
            ->get();

        $this->reservation_id = mt_rand(10000000, 99999999);
        $user = Auth::user()->id;
//  the total amount on this room (s) will be store on each room instnace , but nor on reservation group- just for record, even if the reservation is in a group (thats more than one room in the reservation ID),
        foreach ($this->allocations as $this->allocation) {
            Reservation::create([
                'user_id' => $user,
                'category_id' => $this->category_id,
                'room_id' => $this->allocation->room_id,
                'medium' => $this->medium,
                'nor' => $this->nor,
                'unit_price' => $this->allocation->price,
                'total_amount' => Helper::get_total_amount_due_plain($this->checkin, $this->checkout, $this->category_id, 1), // calculate amount on each room only
                'fullname' => $this->fullname,
                'address' => $this->address,
                'requests' => $this->requests,
                'email' => $this->email,
                'phone' => $this->phone,
                'checkin' => $this->checkin,
                'checkout' => $this->checkout,
                'reservation_id' => $this->reservation_id,
                'status' => 'Open', // default status for reservations
                'checkin_status' => 'Pending',
                'checkin_type' => 'Standard',
                'early_checkin_fee' => 0,
                'checkout_status' => 'Pending',
                'checkout_type' => 'Standard',
                'late_checkout_fee' => 0,
                'confirmation_note' => null,
            ]);


            Roomallocation::where('room_id', $this->allocation->room_id)
                ->where('category_id', $this->category_id)
                ->update(['checkin' => $this->checkin, 'checkout' => $this->checkout]);
        }

<<<<<<< HEAD
        return to_route('checkout-reservation', ['reservation_id' => $this->reservation_id]);
=======
        endforeach;
        //dd($this->reservation_id);;

        return to_route('checkout-reservation', ['reservation_id' => $this->reservation_id,]);
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
    }



  
    
}
