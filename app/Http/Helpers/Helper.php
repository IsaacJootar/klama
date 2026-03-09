<<<<<<< HEAD
=======
<?php

use Carbon\Carbon;


// my helper class to write custom functions
class Helper
{

    // for reservations
    public static function format_currency($value)
    {

        return '₦' . number_format($value, 2); //swap for other curencies and do any maths here if neccessary
    }

    // without the string ('₦')
    public static function format_currency_plain($value)
    {

        return number_format($value, 2); //swap for other curencies and do any maths here if neccessary
    }

    public static function get_number_of_days($checkin, $checkout)
    {

        $start =  Carbon::parse($checkin);
        $end =  Carbon::parse($checkout);

        $days =  $start->diffInDays($end); // count days in the selected dates//
        return ($days == 0) ? 1 : $days; //if days return 0 it means one night-weird
    }


    public static function get_total_amount_due_plain($checkin, $checkout, $category_id, $nor)
    {
        $amount = \App\Models\Roomallocation::where('category_id', $category_id)->get()->value('price');
        $amount = $amount * $nor;
        return $amount * static::get_number_of_days($checkin, $checkout);
    }


    public static function is_reserved($room_id, $date)
    {
        if (\App\Models\Reservation::where('checkin', '=', $date)
            ->where('room_id', '=', $room_id)
            ->Where('payment_status', '!=',  'Checkedout') // not already checked out
            ->exists()
        ) {
            echo  "<span class='badge bg-label-warning me-1'> Reserved  </span>";
        } else {
            echo    "<span class='badge bg-label-success me-1'>Free </span>";
        }
    }

    public static function get_total_amount_due($checkin, $checkout, $category_id, $nor)
    {
        $amount = \App\Models\Roomallocation::where('category_id', $category_id)->get()->value('price');
        $amount = $amount * $nor;
        return static::format_currency($amount * static::get_number_of_days($checkin, $checkout));
    }

    //reservation status-paid or pending-find a way to clear abandoned online reservations
    public static function get_reservation_payment_status($reservation_id)
    {
        $payment_status = \App\Models\Reservation::where('reservation_id', $reservation_id)->get()->value('payment_status');
        echo ($payment_status == "Paid") ?
            "<span class='badge bg-label-success me-1'> $payment_status</span>"
            :      "<span class='badge bg-label-warning me-1'>$payment_status</span>";
    }

    public static function get_message_channel_flag($message_id)
    {
        $message_channel = \App\Models\SystemMessage::where('message_id', $message_id)->get()->value('message_type');
        echo ($message_channel == "message") ?
            "<span class='badge bg-label-secondary ms-1'> $message_channel</span>"

            :      "<span class='badge bg-label-info ms-1'>$message_channel</span>";
    }


    public static function reportHasFiles($report_id)
    {
        $count_files = \App\Models\ReportsFileUpload::where('report_id', $report_id)->count();
        echo ($count_files > 0) ?
            "<span class='badge bg-label-success me-1'> Yes ($count_files) </span>"
            :      "<span class='badge bg-label-warning me-1'>No</span>";
    }
}
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
