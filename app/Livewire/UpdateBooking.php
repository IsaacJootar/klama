<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservation;
use App\Models\Roomallocation;
use Livewire\Attributes\Title;


#[title('Update Reservation')]
class UpdateBooking extends Component
{

    public $category_id;
    public $room_id;
    public $nor;
    public $checkin;
    public $checkout;
    public $medium = 'Online';
    public $fullname;
    public $address;
    public $requests;
    public $payment_status;
    public $phone;
    public $email;

    public $allocations;
    public $allocation;
    public $reservation_id;
    public $reservation;

    public function mount($reservation_id)
    {

        $this->reservation = Reservation::where('reservation_id', $reservation_id)->first();
        $this->category_id = $this->reservation->category_id;
        $this->reservation_id = $this->reservation->reservation_id;
        $this->nor = $this->reservation->nor;
        $this->checkin = $this->reservation->checkin;
        $this->checkout = $this->reservation->checkout;
        $this->fullname = $this->reservation->fullname;
        $this->email = $this->reservation->email;
        $this->phone = $this->reservation->phone;
        $this->address = $this->reservation->address;
        $this->requests = $this->reservation->requests;
        $this->checkin = $this->reservation->checkin;
        $this->checkout = $this->reservation->checkout;

        $this->allocations = Roomallocation::with('category')->where('category_id', $this->category_id)->distinct()->get('category_id');

        return view('livewire.update-booking')->layout('layouts.room-search');
    }



    public function render()
    {
        return view('livewire.update-booking')->layout('layouts.room-search');
    }


    public function update()
    {
        //validate inputs

        $validation = $this->validate(
            [
                'email' => ['email:rfc'],
                'nor' => ['required'],
                'fullname' => ['required'],
                'phone' => ['required', 'numeric'],
            ],
            [
                'nor.required' => 'Please select number of room(s).',
                'phone.required' => 'Please Your Contact Number is required.',
                'fullname.required' => 'Please Customer fullname is required.',

            ]
        );


        //act as in create but remove the previous reservations, and create new ones, bcus its posible the customer changed the number of room, which wil affect the former foreach iteration during the create function
        $this->allocations = Roomallocation::where('category_id', $this->category_id)
            ->whereDate('checkin', $this->checkin)
            ->whereDate('checkout', $this->checkout)
            ->limit($this->nor)->get();
            Reservation::where('reservation_id', $this->reservation_id)->delete();

        $this->reservation_id = mt_rand(10000000, 99999999); // generate a new reservation ID, just for convinience

        $user_id = 1001101;
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
            ]);

            Roomallocation::where('room_id', $this->allocation->room_id)
                ->where('category_id', $this->category_id)
                ->update(['checkin' => $this->checkin, 'checkout' => $this->checkout]);
        }

        //dd($this->reservation_id)

        return to_route('checkout-booking', ['reservation_id' => $this->reservation_id,]);
    }




}
