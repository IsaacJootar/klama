<?php

namespace App\Livewire\Reservations;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Reservation;
use Livewire\Attributes\Title;

#[Title('Reservations | Print Receipt')]
class PrintReceipt extends Component
{
    public $reservation_id;
    public $category_id;
    public $checkin;
    public $checkout;
    public $nor;
    public $reservation;

    public $rooms;
    public $allocations;
    public $form_flag;
    public $form_title;

   public function mount($reservation_id)
{
    $this->reservation_id = $reservation_id;

    // Fetch reservation
    $this->reservation = Reservation::where('reservation_id', $this->reservation_id)->first();

    dd($this->reservation); // This will stop execution and dump the reservation data

    if (!$this->reservation) {
        session()->flash('error', 'Reservation not found.');
        return redirect()->route('reserved-rooms'); // Redirect if not found
    }

    // Get rooms associated with the reservation
    $this->rooms = DB::table('resv_reservations')
        ->join('resv_rooms', 'resv_reservations.room_id', '=', 'resv_rooms.id')
        ->where('resv_reservations.reservation_id', $this->reservation_id)
        ->get();

    dd($this->rooms); // Stop execution and dump the rooms data

    $this->category_id = $this->reservation->category_id;
    $this->checkin = $this->reservation->checkin;
    $this->checkout = $this->reservation->checkout;
}


    public function render()
    {
        return view('livewire.reservations.print-receipt', [
            'reservation_id' => $this->reservation_id,
            'category_id' => $this->category_id,
            'checkin' => $this->checkin,
            'checkout' => $this->checkout,
            'rooms' => $this->rooms,
        ])->layout('layouts.reservations');
    }
}
