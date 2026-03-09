<?php

namespace App\Livewire\Reservations;

use Livewire\Component;
use App\Models\Reservation;
<<<<<<< HEAD
use App\Models\Bank;
use App\Models\SalesCoupon;
=======
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
use App\Services\EmailMessageService;
use App\Models\Roomallocation;
use App\Http\Helpers\Helper;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

#[Title('Reservations | Checkout')]
class CheckoutReservation extends Component
{
    public $reservation_id;
    public $banks;
    public $category_id;
    public $checkin;
    public $checkout;
    public $nor;
    public $reservation;
    public $couponCode;
    public $rooms;
    public $allocations;
    public $form_flag;
    public $form_title;
    public $receiving_bank;
    
    
    public function mount()
    {
        $this->reservation = Reservation::where('reservation_id', $this->reservation_id)->first();
<<<<<<< HEAD
        $this->rooms = DB::table('resv_reservations')
            ->join('resv_rooms', 'resv_reservations.room_id', '=', 'resv_rooms.id')
            ->where('reservation_id', $this->reservation_id)
=======

        //get room(s)
        $this->rooms = DB::table('resv_reservations')
            ->join('resv_rooms', 'resv_reservations.room_id', '=', 'resv_rooms.id')
            ->where('reservation_id', $this->reservation_id) // where cond. is on the first table
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
            ->get();
        $this->category_id = $this->reservation->category_id;
        $this->checkin = $this->reservation->checkin;
        $this->checkout = $this->reservation->checkout;
        $this->nor = $this->reservation->nor;
        $this->couponCode = $this->reservation->coupon_code;

        return view('livewire.reservations.checkout-reservation', [
            'reservation_id' => $this->reservation_id,
            'category_id' => $this->category_id,
            'checkin' => $this->checkin,
            'checkout' => $this->checkout,
            'rooms' => $this->rooms,
        ])->layout('layouts.reservations');
    }


    public function render()
    {
        $this->banks = Bank::all();
        return view('livewire.reservations.checkout-reservation')->layout('layouts.reservations');
    }

    public function applyCoupon()
    {
        if (empty($this->couponCode)) {
            toastr()->warning('Please enter a coupon code.');
            return;
        }

        $coupon = SalesCoupon::where('code', $this->couponCode)->first();

        if (!$coupon) {
            toastr()->warning('Invalid coupon code.');
            return;
        }

        if ($coupon->usage_count >= 1) {
            toastr()->warning('Coupon has already been used.');
            return;
        }

        if (Carbon::parse($coupon->end_date)->isPast() || Carbon::parse($coupon->start_date)->isFuture()) {
            toastr()->warning('Coupon is expired or not yet active.');
            return;
        }

        $reservations = Reservation::where('reservation_id', $this->reservation_id)->get();
        $discountPerRoom = $coupon->discount_value / $this->nor;

        foreach ($reservations as $reservation) {
            $baseAmount = $reservation->total_amount + ($reservation->coupon_code ? ($coupon->discount_value / $this->nor) : 0); // Revert previous discount
            $finalAmount = max(0, $baseAmount - $discountPerRoom);

            Reservation::where('id', $reservation->id)->update([
                'total_amount' => $finalAmount,
                'coupon_code' => $this->couponCode,
            ]);
        }

        SalesCoupon::where('code', $this->couponCode)->increment('usage_count');
        toastr()->success('Coupon applied successfully!');
    }

    public function checkout($reservation_id, $room_id, $category_id)
    {
        if (Reservation::where('reservation_id', $reservation_id)
            ->where('payment_status', 'Pending')
            ->exists()) {
            toastr()->warning('Checkout not successful! Payment is yet to be made on this reservation!');
            return to_route('due-rooms');
        }

        Roomallocation::where('category_id', $category_id)
            ->where('room_id', $room_id)
            ->update([
                'checkin' => '1986-09-01',
                'checkout' => '1986-09-01',
            ]);

<<<<<<< HEAD
        Reservation::where('reservation_id', $reservation_id)
            ->update([
                'payment_status' => 'Checkedout',
                
            ]);
        toastr()->info('Customer Has Been Checked Out Successfully');
        return to_route('reserved-rooms');
    }
=======
}


public function comfirmPayment($reservation_id, $email){// for front desk

    Reservation::where('reservation_id', $reservation_id)
            ->update([
                'payment_status'=>'Paid',
                ]); // this wil comfirm for all rooms under that reservation group

                // sent comfirmation Email
        $subject =  'Reservation  Comfirmed';
        $message =  'Your Reservation has been comfirm.  ID:'.$reservation_id;
        $sendmail = app(abstract: EmailMessageService::class); // inject the dependency class
        $sendmail ->ComfirmReservationEmail($message, $email,  $subject);

            toastr()->info('Customer Reservation Has Been Comfirmed');
    return to_route ('reserved-rooms');
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa

    public function comfirmPayment($reservation_id, $email)
    {
        Reservation::where('reservation_id', $reservation_id)
            ->update([
                'payment_status' => 'Paid',
                'bank_id' => $this->receiving_bank,
            ]);
/*
        $subject = 'Reservation Confirmed';
        $message = 'Your Reservation has been confirmed. 
        Welcome to VINE INTERNATIONAL SUITES AND RESORT, your home away from home!
        Here, every moment of your stay is cherished, and we make it memorable.
        Be rest assured that you’ll have a wonderful experience.';
        $sendmail = app(abstract: EmailMessageService::class);
        $sendmail->ComfirmReservationEmail($message, $email, $subject);
*/
        toastr()->info('Customer Reservation Has Been Confirmed');
        return to_route('reserved-rooms');
    }
}