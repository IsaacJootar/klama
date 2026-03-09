<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roomallocation;
use Carbon\Carbon;

class RoomSearchController extends Controller
{
    public function index(Request $request)
    {
        $checkin = $request->input('checkin') ?: Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
        $checkout = $request->input('checkout') ?: Carbon::now()->timezone('Africa/Lagos')->addDay()->format('Y-m-d');

        // Get available room categories excluding those allocated within the date range
        $allocations = Roomallocation::with('category')
            ->whereNotBetween('checkin', [$checkin, $checkout])
            ->whereNotBetween('checkout', [$checkin, $checkout])
            ->orderBy('id', 'desc')
            ->distinct()
            ->get('category_id');

        return view('room-search', compact('checkin', 'checkout', 'allocations'));
    }
}
