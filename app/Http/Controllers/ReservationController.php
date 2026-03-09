<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roomallocation;
use Carbon\Carbon;

class ReservationController extends Controller
{
   public function search(Request $request)
{
    $checkin = $request->input('checkin', now()->format('Y-m-d'));
    $checkout = $request->input('checkout', now()->addDay()->format('Y-m-d'));

    if (Carbon::parse($checkin)->isPast() || Carbon::parse($checkout)->isPast()) {
        return redirect()->back()->with('warning', 'Search cannot include past dates!');
    }

    $allocations = Roomallocation::with('category')
        ->where('status', 'Available')
        ->whereNotBetween('checkin', [$checkin, $checkout])
        ->whereNotBetween('checkout', [$checkin, $checkout])
        ->orderBy('id', 'desc')
        ->distinct()
        ->get('category_id');

    return view('reservations.search-results', compact('allocations', 'checkin', 'checkout'));
}
}
