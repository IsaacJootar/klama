<?php

namespace App\Livewire\Reservations;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\Helper;
use App\Models\Room;
use Livewire\Component;
use App\Models\Reservation;
use App\Models\Roomcategory;
use App\Models\SwapRoom;
use App\Models\Roomallocation;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use App\Services\EmailMessageService;

#[Title('Reservations | Reserved Rooms')]
class ReservedRooms extends Component
{
    
    public $checkin;
    public $checkout;
    public $from_checkin;
    public $from_checkout;
    public $rooms;
    public $categories;
    public $reserved;
    public $swaps;
    public $extend;
    public $room_extend;
    public $swap;
    public $from_category_id;
    public $to_category_id;
    public $to_reservation_id;
    public $reservation_id; // from reservation
    public $room_swap;
    public $swap_to;
    public $room_id;
    public $category_id;
    public $swap_to_id;
    public $swap_from_id;
    public $new_value;
    public $new_ext_value;
    public $swap_type;
    public $status;
    public $customer;
    public $to_customer;
    public $to_phone;
    public $phone;
    public $new_checkout_date;
    public $extension_amount;
    public $confirmation_note;
    public $checkin_type;
    public $early_checkin_fee;
    public $checkout_type;
    public $late_checkout_fee;

    public function mount()
    {

        $this->checkin = Carbon::now('Africa/Lagos')->format('Y-m-d');
        $this->checkout = Carbon::now('Africa/Lagos')->addDay()->format('Y-m-d');

        $this->reserved = Reservation::whereBetween('created_at', [
            Carbon::now()->startOfMonth(), // First day of the current month
            Carbon::now()->endOfMonth()    // Last day of the current month
        ])
            ->where('checkout_status', '!=', 'Checkedout')
            ->distinct('reservation_id')
            ->get();
        $this->rooms = Room::query()->orderBy("id", "desc")->get();
        $this->categories = Roomcategory::orderBy("id", "desc")->get();

        return view('livewire.reservations.reserved-rooms', [
            'reserved' => $this->reserved,
            'rooms' => $this->rooms,
            'categories' => $this->categories,
            'checkin' => $this->checkin,
            'checkout' => $this->checkout,
        ])->layout('layouts.reservations');
    }



    public function render()
    {
        return view('livewire.reservations.reserved-rooms')->layout('layouts.reservations');
    }


    public function confirmPayment($reservation_id, $email)
    { // for front desk

       
        /* sent comfirmation Email
        $subject = 'Reservation  Comfirmed';
        $message =  'Your Reservation has been comfirm. 
 Welcome to VINE INTERNATIONAL SUITES AND RESORT.your home away from home!
 Here, every moment of your stay is cherished, and we make it memorable.
Be rest assured that you’ll have a wonderful experience.
';
        $sendmail = app(abstract: EmailMessageService::class); // inject the dependency class
        $sendmail->ComfirmReservationEmail(mail_message: $message, customer_email: $email,  mail_subject: $subject);
*/

        toastr()->info('Customer Payment Has Been Comfirmed');
        return to_route('reserved-rooms');
    }




    public function cancelReservation($reservation_id)
    { // for front desk
        // later make it room by room
        Reservation::where('reservation_id', $reservation_id)
            ->update([
                'status' => 'closed',
                'flag' => 'Cancelled',
            ]); // this wil comfirm for all rooms under that reservation group
        toastr()->info('Reservation Has Been Cancelled');
        return to_route('reserved-rooms');
    }


    public function printReceipt($reservation_id)
    {

        $reservation = Reservation::where('reservation_id', $reservation_id)->first();

        if (!$reservation) {
            toastr()->error('Reservation not found.');
            return back();
        }

        // Generate receipt data (modify as needed)
        $receiptData = [
            'reservation' => $reservation,
            'rooms' => $reservation->rooms,
            'total_amount' => $reservation->total_amount,
        ];

        // You can pass this data to a view for rendering a printable receipt
        return view('livewire.reservations.print-receipt', $receiptData);
    }
    public function swapRoom($id)
    {


        $this->room_swap = Reservation::findOrFail($id);

        $this->reservation_id = $this->room_swap->reservation_id;
        $this->room_id = $this->room_swap->room_id;
        $this->customer = $this->room_swap->fullname;
        $this->email = $this->room_swap->email;
        $this->swap_from_id = $this->room_swap->room_id; // not for use in blade
        $this->from_category_id = $this->room_swap->category_id;
        $this->from_checkin = $this->room_swap->checkin;
        $this->from_checkout = $this->room_swap->checkout;
    }



    public function save(){ // for front desk


        $this->validate(
    [
        'swap_to_id'  => 'required',
        'new_value' => 'nullable|numeric',
        'swap_type'   => 'required|string',
    ],
    [],
    [
        'swap_to_id' => 'Swap Destination', // Custom error attribute
    ]
);

        $this->swap_to_id;
        $this->to_category_id = Roomallocation::where('room_id', $this->swap_to_id)->value('category_id');
        
         // Get number of rooms (nor) from reservation
        $nor = Reservation::where('reservation_id', $this->reservation_id)->value('nor');

        // Calculate price difference and total amount based on the new room
        $current_room_price = Roomallocation::where('room_id', $this->swap_from_id)->value('price');
        $new_room_price = Roomallocation::where('room_id', $this->swap_to_id)->value('price');
        $swap_value = $new_room_price - $current_room_price; // Positive if new room is more 
    

        
        $total_amount = Helper::get_total_amount_due_plain(
            $this->from_checkin,
            $this->from_checkout,
            $this->to_category_id,
            $nor
        );

        $checkin = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
        $checkout = Carbon::now()->addDays(1)->timezone('Africa/Lagos')->format('Y-m-d');
        $this->swap = Reservation::where('room_id', $this->swap_to_id)
            ->where('category_id', $this->to_category_id)
            ->whereBetween('checkin', [$checkin, $checkout])
            ->whereBetween('checkout', [$checkin, $checkout])  // if swap_to room from form is found to be reserved  between the day swap is happening, so that the affected room reservation will be overwritten
            ->first();
            
        
            
        // so now, if there is NO room within date range that is already reserved,then just use the swap_to room  (already room is coming from form) to replace the  swap from room- BUT leave the arrival and depart. date intact but overide the from_room into the to room-this  is crazy, for now.
        if (!$this->swap) {
            DB::transaction(function () use ($total_amount, $new_room_price, $swap_value, $nor) {
                Reservation::where('reservation_id', $this->reservation_id)
                    ->where('room_id', $this->swap_from_id)
                    ->where('category_id', $this->from_category_id)
                    ->update([
                        'room_id' => $this->swap_to_id,
                        'category_id' => $this->to_category_id,
                        'state' => 'Swapped',
                        'unit_price' => $new_room_price,
                        'total_amount' => $total_amount,
                    ]);
                    
                    

                // Allocation - flag (swap from room)
                \App\Models\Roomallocation::where('room_id', $this->swap_from_id)
                    ->where('category_id', $this->from_category_id)
                    ->update([
                        'status' => 'from_flag', // hard coded flag status
                    ]);

                // Update the arrival and departure dates for the new room (using dates from the old room)
                \App\Models\Roomallocation::where('room_id', $this->swap_to_id)
                    ->where('category_id', $this->to_category_id)
                    ->update([
                        'checkin'  => $this->from_checkin,
                        'checkout' => $this->from_checkout,
                    ]);

                // Update the old room to make it available
                \App\Models\Roomallocation::where('room_id', $this->swap_from_id)
                    ->where('category_id', $this->from_category_id)
                    ->where('status', 'from_flag')
                    ->update([
                        'checkin'  => '1986-09-01',  // default reservation date
                        'checkout' => '1986-09-01',  // default reservation date
                        'status'   => 'Available',   // room(s) default state
                    ]);
            });



            $user_id = Auth::user()->id;

            SwapRoom::create([
                'user_id'    => $user_id,
                'swap_from_id'    => $this->swap_from_id,
                'swap_to_id'    => $this->swap_to_id,
                'from_category_id'    => $this->from_category_id,
                'to_category_id'    => $this->to_category_id,
                'from_reservation_id' => $this->reservation_id,
                'swap_type'      => $this->swap_type,
                'swap_value' =>   $swap_value,
            ]);



            toastr()->info('Room Swap Was Successful');
            return to_route('reserved-rooms');
        }

        // that is, if the swap to room is already reserved
         if ($this->swap) {
            $this->to_reservation_id = $this->swap->reservation_id;
            $this->to_customer = $this->swap->fullname;
            $this->to_phone = $this->swap->phone;
            $this->to_email = $this->swap->email;

            DB::transaction(function () use ($total_amount, $new_room_price, $swap_value, $nor) {
                Reservation::where('reservation_id', $this->to_reservation_id)
                    ->where('room_id', $this->swap_to_id)
                    ->where('category_id', $this->to_category_id)
                    ->update([
                        'state' => 'swapped',
                        'status' => 'closed',
                        'flag' => 'Cancelled',
                    ]);
                    
                // Reservation - if room is found within date range (that is already reserved),
                // get the room_id to update for the incoming room.

                    Reservation::where('reservation_id', $this->reservation_id)
                    ->where('room_id', $this->swap_from_id)
                    ->where('category_id', $this->from_category_id)
                    ->update([
                        'room_id' => $this->swap_to_id,
                        'category_id' => $this->to_category_id,
                        'state' => 'Swapped',
                        'unit_price' => $new_room_price,
                        'total_amount' => $total_amount,
                    ]);

                // Allocation - flag (swap from room)
                \App\Models\Roomallocation::where('room_id', $this->swap_from_id)
                    ->where('category_id', $this->from_category_id)
                    ->update([
                        'status' => 'from_flag', // hard coded flag status
                    ]);

                // Update the arrival and departure dates for the new room (using dates from the old room)
                \App\Models\Roomallocation::where('room_id', $this->swap_to_id)
                    ->where('category_id', $this->to_category_id)
                    ->update([
                        'checkin'  => $this->from_checkin,
                        'checkout' => $this->from_checkout,
                    ]);

                // Update the old room to make it available
                \App\Models\Roomallocation::where('room_id', $this->swap_from_id)
                    ->where('category_id', $this->from_category_id)
                    ->where('status', 'from_flag')
                    ->update([
                        'checkin'  => '1986-09-01',  // default reservation date
                        'checkout' => '1986-09-01',  // default reservation date
                        'status'   => 'Available',   // room(s) default state
                    ]);


                // Finally, delete the swapped room record from the Reservation table,
                // only if any one of the flags is present.
                \App\Models\Reservation::where('reservation_id', $this->to_reservation_id)
                    ->where('room_id', $this->swap_to_id)
                    ->where('state', 'swapped')
                    ->delete();
            });





            //send a mail here if neccessary$user_id = Auth::user()->id;
            $user_id = Auth::user()->id;

            SwapRoom::create([
                'user_id'    => $user_id,
                'swap_from_id'    => $this->swap_from_id,
                'swap_to_id'    => $this->swap_to_id,
                'from_category_id'    => $this->from_category_id,
                'to_category_id'    => $this->to_category_id,
                'from_reservation_id' => $this->reservation_id,
                'to_reservation_id' => $this->to_reservation_id,
                'to_customer'       => $this->to_customer,
                'to_phone'           => $this->to_phone,
                'to_email'          => $this->to_email,
                'swap_type'      => $this->swap_type,
                'swap_value' => $swap_value,
            ]);
            toastr()->info('Room Swap Was Successful');
            return to_route('reserved-rooms');
        }
    }
    
    

    public function extendReservation($id)
    {
        $this->room_extend = Reservation::findOrFail($id);

        $this->reservation_id = $this->room_extend->reservation_id;
        $this->room_id = $this->room_extend->room_id;
        $this->customer = $this->room_extend->fullname;
        $this->email = $this->room_extend->email;
        $this->category_id = $this->room_extend->category_id;
        $this->checkin = $this->room_extend->checkin;
        $this->checkout = $this->room_extend->checkout;
        $this->extension_amount = 0; // Initialize
        session()->put('original_checkout', $this->checkout); // Store original checkout in session
    }

    public function updatedNewCheckoutDate($value)
    {
        $this->extension_amount = 0; // Reset

        if ($value && $this->reservation_id && $this->room_id && $this->category_id) {
            $reservation = Reservation::where('reservation_id', $this->reservation_id)
                ->where('room_id', $this->room_id)
                ->where('category_id', $this->category_id)
                ->first();
            $original_checkout = session('original_checkout');

            if ($reservation && $original_checkout) {
                try {
                    $new_checkout = Carbon::parse($value);
                    $original = Carbon::parse($original_checkout);

                    if ($new_checkout->greaterThan($original)) {
                        // Calculate extension amount for the specific room with nor = 1
                        $this->extension_amount = Helper::get_total_amount_due_plain(
                            $original_checkout,
                            $value,
                            $this->category_id,
                            1 // Use nor = 1 for single room extension
                        );
                    }
                } catch (\Exception $e) {
                    // Handle invalid date parsing
                    $this->extension_amount = 0;
                }
            }
        }
    }



 public function confirmCheckIn($id)
    {
        $this->reservation = Reservation::findOrFail($id);
        $this->reservation_id = $this->reservation->reservation_id;
        $this->room_id = $this->reservation->room_id;
        $this->customer = $this->reservation->fullname;
        $this->email = $this->reservation->email;
        $this->checkin = $this->reservation->checkin;
        $this->checkout = $this->reservation->checkout;
        $this->confirmation_note = '';
        $this->checkin_type = 'Standard';
        $this->early_checkin_fee = 0;
    }

    public function saveCheckIn()
    {
        $this->validate([
            'confirmation_note' => 'required|string|max:500',
            'checkin_type' => 'required|in:Standard,Early Check-In',
            'early_checkin_fee' => 'required_if:checkin_type,Early Check-In|numeric|min:0',
        ], [], [
            'confirmation_note' => 'Confirmation Note',
            'checkin_type' => 'Check-In Type',
            'early_checkin_fee' => 'Early Check-In Fee',
        ]);

        $reservation = Reservation::where('reservation_id', $this->reservation_id)
            ->where('room_id', $this->room_id)
            ->first();

        if (!$reservation) {
            toastr()->error('Room reservation not found.');
            return to_route('reserved-rooms');
        }

        DB::transaction(function () use ($reservation) {
            $updated_total_amount = $reservation->total_amount + ($this->checkin_type === 'Early Check-In' ? $this->early_checkin_fee : 0);

            Reservation::where('reservation_id', $this->reservation_id)
                ->where('room_id', $this->room_id)
                ->update([
                    'checkin_status' => 'Checkedin',
                    'checkin_type' => $this->checkin_type,
                    'early_checkin_fee' => $this->checkin_type === 'Early Check-In' ? $this->early_checkin_fee : 0,
                    'confirmation_note' => $this->confirmation_note,
                    'total_amount' => $updated_total_amount,
                ]);
        });

       
        /*
         $fee_text = $this->checkin_type === 'Early Check-In' ? "\nEarly Check-In Fee: " . Helper::format_currency($this->early_checkin_fee) : '';
        $room_name = \App\Models\Room::where('id', $this->room_id)->value('name');
        
        $subject = 'Room Check-In Confirmed';
        $message = "Dear {$this->customer},\nYour {$this->checkin_type} check-in for room {$room_name} (Reservation ID: {$this->reservation_id}) has been confirmed at VINE INTERNATIONAL SUITES AND RESORT. We hope you enjoy your stay!\n\nConfirmation Note: {$this->confirmation_note}{$fee_text}\n\nWelcome to your home away from home!";
        $sendmail = app(abstract: EmailMessageService::class);
        $sendmail->ComfirmReservationEmail(mail_message: $message, customer_email: $this->email, mail_subject: $subject);
        */
        toastr()->info('Room Check-In Confirmed');
        return to_route('reserved-rooms');
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

        toastr()->info('Room Check-Out Confirmed');
        return to_route('reserved-rooms');
    }



     public function saveExtension()
    {
        $this->validate([
            'new_checkout_date' => 'required|date|after:today',
        ]);

        if (empty($this->new_checkout_date)) {
            toastr()->error('Invalid checkout date provided.');
            return to_route('reserved-rooms');
        }

        $reservation = Reservation::where('reservation_id', $this->reservation_id)
            ->where('room_id', $this->room_id)
            ->where('category_id', $this->category_id)
            ->first();

        if (!$reservation) {
            toastr()->error('Reservation not found.');
            return to_route('reserved-rooms');
        }

        $original_checkout = session('original_checkout');
        $new_checkout_date = $this->new_checkout_date;

        // Check for conflicts for the extended room
        $this->extend = Reservation::where('room_id', $this->room_id)
            ->where('category_id', $this->category_id)
            ->where('id', '!=', $reservation->id)
            ->where(function ($query) use ($original_checkout, $new_checkout_date) {
                $query->where('checkin', '<=', $new_checkout_date)
                      ->where('checkout', '>=', $original_checkout);
            })
            ->first();

        if (!$this->extend) {
            DB::transaction(function () use ($reservation, $new_checkout_date) {
                // Update only the extended room with nor = 1
                $total_amount = Helper::get_total_amount_due_plain(
                    $reservation->checkin,
                    $new_checkout_date,
                    $reservation->category_id,
                    1 // Use nor = 1 for single room extension
                );

                Reservation::where('reservation_id', $this->reservation_id)
                    ->where('room_id', $this->room_id)
                    ->where('category_id', $this->category_id)
                    ->update([
                        'checkout' => $new_checkout_date,
                        'state' => 'Extended',
                        'total_amount' => $total_amount
                    ]);

                Roomallocation::where('room_id', $this->room_id)
                    ->where('category_id', $this->category_id)
                    ->update(['checkout' => $new_checkout_date]);

                session()->forget('original_checkout'); // Clear session
            });

            toastr()->info('Room Extension Was Successful');
            return to_route('reserved-rooms');
        }

        toastr()->warning('New Departure date cannot be used, period is already occupied!');
        return to_route('reserved-rooms');
    }
}