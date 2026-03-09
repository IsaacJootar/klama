<?php

namespace App\Livewire\General;

use Livewire\Component;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;

#[Title('Reservation Calendar')]
class ReservationCalendar extends Component
{
    public $events;

    public function mount()
    {
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $today = Carbon::today()->timezone('Africa/Lagos');

        // Fetch reservations with room details, only where checkout_status is Pending
        $reservations = Reservation::select(
            'resv_reservations.reservation_id',
            'resv_reservations.fullname',
            'resv_reservations.room_id',
            'resv_reservations.checkin',
            'resv_reservations.checkout',
            'resv_reservations.checkin_status',
            'resv_rooms.name as room_name'
        )
        ->join('resv_rooms', 'resv_reservations.room_id', '=', 'resv_rooms.id')
        ->where('resv_reservations.checkout_status', 'Pending')
        ->whereYear('resv_reservations.checkin', '>=', $today->year)
        ->get();

        $this->events = $reservations->map(function ($reservation) use ($today) {
            $isCheckedIn = $reservation->checkin_status === 'Checkedin' &&
                           Carbon::parse($reservation->checkin)->lte($today) &&
                           Carbon::parse($reservation->checkout)->gte($today);

            return [
                'title' => "{$reservation->fullname} (Room: {$reservation->room_name})",
                'start' => Carbon::parse($reservation->checkin)->format('Y-m-d'),
                'end' => Carbon::parse($reservation->checkout)->addDay()->format('Y-m-d'), // Include checkout date
                'extendedProps' => [
                    'reservation_id' => $reservation->reservation_id,
                    'room_id' => $reservation->room_id,
                    'room_name' => $reservation->room_name,
                    'checkin_status' => $reservation->checkin_status,
                ],
                'backgroundColor' => $isCheckedIn ? '#059669' : '#3b82f6',
                'borderColor' => $isCheckedIn ? '#047857' : '#1e40af',
                'textColor' => '#ffffff',
            ];
        })->toArray();
    }

    public function refreshEvents()
    {
        $this->loadEvents();
        $this->dispatch('eventsUpdated');
    }

    public function render()
    {
        return view('livewire.general.reservation-calendar', [
            'events' => $this->events,
        ])->layout('layouts.director');
    }
}