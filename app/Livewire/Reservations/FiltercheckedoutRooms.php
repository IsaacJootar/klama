<?php

namespace App\Livewire\Reservations;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Reservation;
use Livewire\Attributes\Title;

#[Title('Reservations | Filter CheckedOut Rooms')]
<<<<<<< HEAD
class FiltercheckedoutRooms extends Component
{
    public $reservations;
    public $due_period;

    public function due()
    {
        $today = Carbon::today()->timezone('Africa/Lagos')->format('Y-m-d');
        $periods = [
            'today' => 'Today',
            'yesterday' => 'Yesterday',
            'week' => 'Last Week',
            'month' => 'Last Month',
            'year' => 'Last Year',
            'all' => 'All Time',
        ];
        $period = $periods[$this->due_period] ?? 'Today';

        switch ($this->due_period) {
            case 'today':
                $this->reservations = Reservation::whereDate('updated_at', $today)
                    ->where('checkout_status', '=', 'Checkedout')
                    ->orderBy('id', 'desc')->get();
                $this->dispatch('refresh-filter-checkedout-rooms', $today, $today, $period);
                break;

            case 'yesterday':
                $yesterday = Carbon::yesterday()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereDate('updated_at', $yesterday)
                    ->where('checkout_status', '=', 'Checkedout')
                    ->orderBy('id', 'desc')->get();
                $this->dispatch('refresh-filter-checkedout-rooms', $yesterday, $yesterday, $period);
                break;

            case 'week':
                $start = Carbon::today()->subDays(7)->startOfDay()->timezone('Africa/Lagos')->format('Y-m-d');
                $end = $today;
                $this->reservations = Reservation::whereBetween('checkout', [$start, $end])
                    ->where('checkout_status', '=', 'Checkedout')
                    ->orderBy('id', 'desc')->get();
                $this->dispatch('refresh-filter-checkedout-rooms', $start, $end, $period);
                break;

            case 'month':
                $start = Carbon::today()->subMonth()->startOfMonth()->timezone('Africa/Lagos')->format('Y-m-d');
                $end = Carbon::today()->subMonth()->endOfMonth()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [$start, $end])
                    ->where('checkout_status', '=', 'Checkedout')
                    ->orderBy('id', 'desc')->get();
                $this->dispatch('refresh-filter-checkedout-rooms', $start, $end, $period);
                break;

            case 'year':
                $start = Carbon::today()->subYear()->startOfYear()->timezone('Africa/Lagos')->format('Y-m-d');
                $end = Carbon::today()->subYear()->endOfYear()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [$start, $end])
                    ->where('checkout_status', '=', 'Checkedout')
                    ->orderBy('id', 'desc')->get();
                $this->dispatch('refresh-filter-checkedout-rooms', $start, $end, $period);
                break;

            case 'all':
                $this->reservations = Reservation::where('checkout_status', '=', 'Checkedout')
                    ->orderBy('id', 'desc')->get();
                $start = Carbon::today()->subYears(5)->startOfYear()->timezone('Africa/Lagos')->format('Y-m-d');
                $end = $today;
                $this->reservations = Reservation::where('checkout_status', '=', 'Checkedout')
                    ->orderBy('id', 'desc')->get();
                $this->dispatch('refresh-filter-checkedout-rooms', $start, $end, $period);
                break;

            default:
                $this->reservations = Reservation::whereDate('updated_at', $today)
                    ->where('checkout_status', '=', 'Checkedout')
                    ->orderBy('id', 'desc')->get();
                $this->dispatch('refresh-filter-checkedout-rooms', $today, $today, $period);
=======
class FilterCheckedoutRooms extends Component
{

    public $reservations;
    public $today;
    public $start;
    public $end;
    public $yesterday;

    public $tomorrow;

    public $month;

    public $twomonths;
    public $threemonths;
    public $three;
    public $four;
    public $week;

    public $year;
    public $period;
    public $due_period;



    public function due()
    {

        switch ($this->due_period) {
            case 'yesterday':

                $this->tomorrow = Carbon::yesterday()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [$this->tomorrow, $this->tomorrow])
                    ->Where('payment_status', '=',  'Checkedout')
                    ->orderBy("id", "desc")->get();
                $this->dispatch('refresh-filter-due-rooms', $this->tomorrow, $this->tomorrow); //pass the  DB query to disptach - view

                break;

            case 'three':
                $this->three = Carbon::now()->addDays(-3)->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [$this->three, $this->three])
                    ->Where('payment_status', '=',  'Checkedout')
                    ->orderBy("id", "desc")->get();
                $this->dispatch('refresh-filter-due-rooms', $this->three, $this->three);
                break;
            case 'four':
                $this->four = Carbon::now()->addDays(-4)->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [$this->four, $this->four])
                    ->Where('payment_status', '=',  'Checkedout')
                    ->orderBy("id", "desc")->get();
                $this->dispatch('refresh-filter-due-rooms', $this->four, $this->four);
                break;

            case 'week': // past  week
                $this->week = Carbon::now()->addDays(-7)->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [ $this->week , $this->week])
                    ->Where('payment_status', '=',  'Checkedout')
                    ->orderBy("id", "desc")->get();
                $this->dispatch('refresh-filter-due-rooms',  $this->week , $this->week);
                break;

            case 'month': // within the next one month

                $this->start = Carbon::now()->subMonth()->startOfMonth()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->end = Carbon::now()->subMonth()->endOfMonth()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->month = Carbon::now()->addMonth()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [$this->start, $this->end])
                    ->Where('payment_status', '=',  'Checkedout')
                    ->orderBy("id", "desc")->get();
                $this->dispatch('refresh-filter-due-rooms', $this->start, $this->end);

                break;

            case 'year':  // a year from now
                $this->start = Carbon::now()->subYear()->startOfYear()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->end =Carbon::now()->subYear()->endOfYear()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [$this->start, $this->end])
                ->Where('payment_status', '=',  'Checkedout')
                ->orderBy("id", "desc")->get();
                $this->dispatch('refresh-filter-due-rooms', $this->start, $this->end);

                break;

            default:
                $this->period = Carbon::today()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereDate('checkout', $this->period)
                    ->Where('payment_status', '=',  'Checkedout')
                    ->orderBy("id", "desc")->get();
                $this->dispatch('refresh-filter-due-rooms', $this->period, $this->period); //pass the  DB query parameters to disptach - view
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
                break;
        }

        toastr()->info('Search is complete');
<<<<<<< HEAD
        $this->reset('due_period');
    }

    public function exit()
    {
        $this->reset('due_period');
    }

=======
        $this->reset();
    }



    public function exit()
    { //rest modal feilds
        $this->reset();
    }
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
    public function render()
    {
        return view('livewire.reservations.filtercheckedout-rooms');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
