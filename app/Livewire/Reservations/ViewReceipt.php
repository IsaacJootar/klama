<?php

namespace App\Livewire\Reservations;

use Livewire\Component;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Roomcategory;
use App\Models\Roomallocation;
use App\Http\Helpers\Helper;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;
use Carbon\Carbon;

#[Title('Reservation Receipt')]
class ViewReceipt extends Component
{
    public $reservation_id;
    public $customer;
    public $phone;
    public $email;
    public $payment_medium;
    public $payment_status;
    public $total_amount;
    public $coupon_code;
    public $total_discount;
    public $rooms = [];
    public $early_checkin_fee;
    public $checkin_type;
    public $late_checkout_fee;
    public $checkout_type;

    public function mount($reservation_id)
    {
        $this->reservation_id = $reservation_id;

        try {
            $reservations = Reservation::where('reservation_id', $this->reservation_id)->get();

            if ($reservations->isEmpty()) {
                toastr()->warning('Reservation not found.');
                return redirect()->route('reserved-rooms');
            }

            $this->customer = $reservations->first()->fullname;
            $this->phone = $reservations->first()->phone;
            $this->email = $reservations->first()->email;
            $this->payment_medium = $reservations->first()->medium;
            $this->payment_status = Helper::get_reservation_payment_status($this->reservation_id);
            $this->coupon_code = $reservations->first()->coupon_code;
            $this->total_amount = 0;
            $this->total_discount = 0;
            $this->early_checkin_fee = $reservations->first()->early_checkin_fee;
            $this->checkin_type = $reservations->first()->checkin_type;
            $this->late_checkout_fee = $reservations->first()->late_checkout_fee;
            $this->checkout_type = $reservations->first()->checkout_type;

            foreach ($reservations as $reservation) {
                $room = Room::where('id', $reservation->room_id)->first();
                $category = Roomcategory::where('id', $reservation->category_id)->first();
                $unit_price = Roomallocation::where('room_id', $reservation->room_id)->value('price');

                if (!$room || !$category || is_null($unit_price)) {
                    toastr()->warning('Invalid room or category data.');
                    return redirect()->route('reserved-rooms');
                }

                $nights = Carbon::parse($reservation->checkin)->diffInDays(Carbon::parse($reservation->checkout));
                $subtotal = $unit_price * $nights;
                $this->total_amount += $reservation->total_amount; // Use discounted total_amount from reservations
                $this->total_discount += ($subtotal - $reservation->total_amount);

                $this->rooms[] = [
                    'room_name' => $room->name,
                    'category_name' => $category->category,
                    'unit_price' => $unit_price,
                    'checkin' => $reservation->checkin,
                    'checkout' => $reservation->checkout,
                    'nights' => $nights,
                    'subtotal' => $subtotal, // Undiscounted for display
                    'early_checkin_fee' => $reservation->early_checkin_fee,
                    'checkin_type' => $reservation->checkin_type,
                    'late_checkout_fee' => $reservation->late_checkout_fee,
                    'checkout_type' => $reservation->checkout_type,
                ];
            }

        } catch (\Exception $e) {
            toastr()->warning('Error fetching reservation data.');
            return redirect()->route('reserved-rooms');
        }
    }

    public function render()
    {
        return view('livewire.reservations.view-receipt')->layout('layouts.reservations');
    }
}