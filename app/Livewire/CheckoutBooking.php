<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservation;
use App\Models\Bank;
use App\Models\SalesCoupon;
use App\Services\EmailMessageService;
use App\Models\Roomallocation;
use App\Http\Helpers\Helper;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

#[Title('Online Reservations | Checkout')]
class CheckoutBooking extends Component
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
        $this->rooms = DB::table('resv_reservations')
            ->join('resv_rooms', 'resv_reservations.room_id', '=', 'resv_rooms.id')
            ->where('reservation_id', $this->reservation_id)
            ->get();
        $this->category_id = $this->reservation->category_id;
        $this->checkin = $this->reservation->checkin;
        $this->checkout = $this->reservation->checkout;
        $this->nor = $this->reservation->nor;
        $this->couponCode = $this->reservation->coupon_code;

        return view('livewire.checkout-booking', [
            'reservation_id' => $this->reservation_id,
            'category_id' => $this->category_id,
            'checkin' => $this->checkin,
            'checkout' => $this->checkout,
            'rooms' => $this->rooms,
        ])->layout('layouts.room-search');
    }

    public function render()
    {
        $this->banks = Bank::all();
        return view('livewire.checkout-booking')->layout('layouts.room-search');
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
        $oldCouponCode = $reservations->first()->coupon_code;

        // Revert previous coupon usage if different
        if ($oldCouponCode && $oldCouponCode !== $this->couponCode) {
            SalesCoupon::where('code', $oldCouponCode)->decrement('usage_count');
        }

        $discountPerRoom = $coupon->discount_value / $this->nor;

        foreach ($reservations as $reservation) {
            $baseAmount = $reservation->total_amount + ($reservation->coupon_code ? ($reservation->coupon_code === $this->couponCode ? 0 : ($coupon->discount_value / $this->nor)) : 0);
            $finalAmount = max(0, $baseAmount - $discountPerRoom);

            Reservation::where('id', $reservation->id)->update([
                'total_amount' => $finalAmount,
                'coupon_code' => $this->couponCode,
            ]);
        }

        SalesCoupon::where('code', $this->couponCode)->increment('usage_count');
        toastr()->success('Coupon applied successfully!');
    }

    public function comfirmPayment($reservation_id, $email)
    {
        Reservation::where('reservation_id', $reservation_id)
            ->update([
                'payment_status' => 'Paid',
                 'bank_id' => $this->receiving_bank,
            ]);
/*
        $subject = 'Reservation Comfirmed';
        $message = 'Your Reservation has been comfirm. ID: ' . $reservation_id;
        $sendmail = app(abstract: EmailMessageService::class);
        $sendmail->ComfirmReservationEmail($message, $email, $subject);
*/
        toastr()->info('Customer Reservation Has Been Comfirmed');
        return to_route('reserved-rooms');
    }
}