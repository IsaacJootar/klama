<?php

namespace App\Livewire\Reservations;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Reservation;
use Livewire\Attributes\On;
use App\Models\Roomallocation;
use Livewire\Attributes\Title;
use Illuminate\Validation\ValidationException;
#[Title('Reservations | Due Rooms')]
class DueRooms extends Component
{

    public $reservations;
    public $reservation;
    public $reservation_id;
    public $room_id;
    public $category_id;
    public $due_today;
    public $confirmation_note;
    public $checkout_type;
    public $late_checkout_fee;

    public function mount() {
        // for due rooms in the past-forgoten - notification should have handlesd this, atleast reminder
        $this->due_today = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
           $this->reservations = Reservation::whereDate('checkout', '<=', $this->due_today )
            ->Where('payment_status', '!=',  'Checkedout') // not already checked out
            ->orderBy("id","desc")->get();
            return view('livewire.reservations.due-rooms', [
                'reservations' => $this->reservations,
            ])->layout('layouts.reservations');




        }

            // Event Handler for re-rendering due rooms view
        #[On('refresh-filter-due-rooms')]
        public function refreshFilterDueRooms($search_due1, $search_due2 ){
            //dd($this->reservations = $search_due);
            $this->reservations = Reservation::whereBetween('checkout', [$search_due1, $search_due2])
            ->Where('payment_status', '!=',  'Checkedout') // not already checked out
            ->orderBy("id","desc")->get();



        }




    public function render()
    {
        return view('livewire.reservations.due-rooms')->layout('layouts.reservations');
    }

 public function confirmCheckOut($id)
    {
        $this->reservation = Reservation::findOrFail($id);
        $this->reservation_id = $this->reservation->reservation_id;
        $this->room_id = $this->reservation->room_id;
        $this->customer = $this->reservation->fullname;
        $this->email = $this->reservation->email;
        $this->checkin = $this->reservation->checkin;
        $this->checkout = $this->reservation->checkout;
        $this->confirmation_note = '';
        $this->checkout_type = 'Standard';
        $this->late_checkout_fee = 0;
    }

    public function saveCheckOut()
    {
        $this->validate([
            'confirmation_note' => 'required|string|max:500',
            'checkout_type' => 'required|in:Standard,Late Check-Out',
            'late_checkout_fee' => 'required_if:checkout_type,Late Check-Out|numeric|min:0',
        ], [], [
            'confirmation_note' => 'Confirmation Note',
            'checkout_type' => 'Check-Out Type',
            'late_checkout_fee' => 'Late Check-Out Fee',
        ]);

        $reservation = Reservation::where('reservation_id', $this->reservation_id)
            ->where('room_id', $this->room_id)
            ->first();

        if (!$reservation) {
            toastr()->warning('Room reservation not found.');
            return to_route('reserved-rooms');
        }

        DB::transaction(function () use ($reservation) {
            $updated_total_amount = $reservation->total_amount + ($this->checkout_type === 'Late Check-Out' ? $this->late_checkout_fee : 0);

            Reservation::where('reservation_id', $this->reservation_id)
                ->where('room_id', $this->room_id)
                ->update([
                    'checkout_status' => 'Checkedout',
                    'checkout_type' => $this->checkout_type,
                    'late_checkout_fee' => $this->checkout_type === 'Late Check-Out' ? $this->late_checkout_fee : 0,
                    'confirmation_note' => $this->confirmation_note,
                    'total_amount' => $updated_total_amount,
                    'payment_status' => 'Checkedout',
                ]);

            Roomallocation::where('room_id', $this->room_id)
                ->update([
                    'checkin' => '1986-09-01',
                    'checkout' => '1986-09-01',
                    'status' => 'Available',
                ]);
        });
        
          toastr()->info('Customer  Has Been Checked out Successfully');
        return to_route ('due-rooms');

}


    public function checkout($reservation_id, $category_id, $room_id){
        if(Reservation::where('reservation_id', $reservation_id)
        ->where('payment_status', 'pending')
        ->exists()){

            {

                throw ValidationException::withMessages(['message' => ['Checkout is unsuccessful. Payment is yet to be received on this reservation!']]);
            }

}
        Roomallocation::where('category_id', $category_id)
                        ->where('room_id', $room_id)
                        ->update([
                    'checkin'=>'1986-09-01', //reset dates back to default past dates
                    'checkout'=>'1986-09-01',
                    ]);

        Reservation::where('reservation_id', $reservation_id)
                ->update([
                    'payment_status'=>'Checkedout',
                    ]);
        toastr()->info('Customer  Has Been Checked out Successfully');
        return to_route ('due-rooms');


    }




}





