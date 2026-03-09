<?php

namespace App\Livewire\Reservations;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Reservation;
use Livewire\Attributes\Title;

#[Title('Reservations | Filter Due Rooms')]
class FilterDueRooms extends Component
{

    public $reservations;
    public $today;
    public $five;
    public $tomorrow;

    public $next;
    public $nextmonth;
    public $twomonths;
    public $threemonths;
    public $three;
    public $four;
    public $week;
    public $month;
    public $year;
    public $period;
    public $due_period;



    public function due()
    {

        switch ($this->due_period) {
            case 'tomorrow':

                $this->tomorrow = Carbon::tomorrow()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [$this->tomorrow, $this->tomorrow])
                    ->Where('payment_status', '!=',  'Checkedout')
                    ->orderBy("id", "desc")->get();
                $this->dispatch('refresh-filter-due-rooms', $this->tomorrow, $this->tomorrow); //pass the  DB query to disptach - view

                break;

            case 'next':
                $this->next = Carbon::now()->addDays(2)->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [$this->next, $this->next])
                    ->Where('payment_status', '!=',  'Checkedout')
                    ->orderBy("id", "desc")->get();
                $this->dispatch('refresh-filter-due-rooms', $this->next, $this->next);
                break;
            case 'three':
                $this->three = Carbon::now()->addDays(3)->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [$this->three, $this->three])
                    ->Where('payment_status', '!=',  'Checkedout')
                    ->orderBy("id", "desc")->get();
                $this->dispatch('refresh-filter-due-rooms', $this->three, $this->three);
                break;
            case 'four':
                $this->four = Carbon::now()->addDays(4)->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [$this->four, $this->four])
                    ->Where('payment_status', '!=',  'Checkedout')
                    ->orderBy("id", "desc")->get();
                $this->dispatch('refresh-filter-due-rooms', $this->four, $this->four);
                break;
            case 'five': // within the next 5 days
                $this->today = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');

                $this->five = Carbon::now()->addDays(5)->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [$this->today, $this->five])
                    ->Where('payment_status', '!=',  'Checkedout')
                    ->orderBy("id", "desc")->get();
                $this->dispatch('refresh-filter-due-rooms', $this->today, $this->five);
                break;

            case 'week': // within the next week days
                $this->today = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->week = Carbon::now()->addDays(7)->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [$this->today, $this->week])
                    ->Where('payment_status', '!=',  'Checkedout')
                    ->orderBy("id", "desc")->get();
                $this->dispatch('refresh-filter-due-rooms', $this->today, $this->week);
                break;

            case 'month': // within the next one month
                $this->today = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->month = Carbon::now()->addMonth()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [$this->today, $this->month])
                    ->Where('payment_status', '!=',  'Checkedout')
                    ->orderBy("id", "desc")->get();
                $this->dispatch('refresh-filter-due-rooms', $this->today, $this->month);

                break;



            case 'nextmonth': // within the next one month
                $this->today = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->nextmonth = Carbon::now()->addMonths(1)->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [$this->today, $this->nextmonth])
                    ->Where('payment_status', '!=',  'Checkedout')
                    ->orderBy("id", "desc")->get();
                $this->dispatch('refresh-filter-due-rooms', $this->today, $this->nextmonth);

                break;

            case 'twomonth': // 2 month from now
                $this->today = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->twomonths = Carbon::now()->addMonths(2)->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [$this->today, $this->twomonths])
                    ->Where('payment_status', '!=',  'Checkedout')
                    ->orderBy("id", "desc")->get();
                $this->dispatch('refresh-filter-due-rooms', $this->today, $this->twomonths);

                break;
            case 'threemonth': //  3 months from now
                $this->today = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->threemonths = Carbon::now()->addMonths(3)->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereBetween('checkout', [$this->today, $this->threemonths])
                    ->Where('payment_status', '!=',  'Checkedout')
                    ->orderBy("id", "desc")->get();
                $this->dispatch('refresh-filter-due-rooms', $this->today, $this->threemonths);

                break;

            case 'year':  // a year from now
                $this->today = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->year = Carbon::now()->addYear()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereDate('checkout', $this->year)
                    ->Where('payment_status', '!=',  'Checkedout')
                    ->orderBy("id", "desc")->get();
                $this->dispatch('refresh-filter-due-rooms', $this->today, $this->year);

                break;

            default:
                $this->period = Carbon::today()->timezone('Africa/Lagos')->format('Y-m-d');
                $this->reservations = Reservation::whereDate('checkout', $this->period)
                    ->Where('payment_status', '!=',  'Checkedout')
                    ->orderBy("id", "desc")->get();
                $this->dispatch('refresh-filter-due-rooms', $this->period, $this->period); //pass the  DB query to disptach - view
                break;
        }

        //toastr()->info('Search was successful');
        $this->reset();
    }



    public function exit()
    { //rest modal feilds
        $this->reset();
    }
    public function render()
    {
        return view('livewire.reservations.filter-due-rooms');
    }
}
