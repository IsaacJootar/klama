@php
    use Carbon\Carbon;
    use App\Http\Helpers\Helper;
    use Illuminate\Support\Str;
@endphp

<div class="container-xxl flex-grow-1 container-p-y">
    <x-home-page-label>Checked-Out Rooms as at {{ Carbon::now()->timezone('Africa/Lagos')->format('l, jS \of F, Y') }}</x-home-page-label>
    <div class="d-flex gap-2">
        <x-modal-home-create-plain-button data-bs-target="#filterCheckedDate">
            <i class="ti ti-search me-1"></i> Filter Checkout Dates
        </x-modal-home-create-plain-button>
        @if($reservations->isNotEmpty())
            <button wire:click="toggleCustomerList" class="btn btn-primary">
                <i class="ti ti-list me-1"></i> {{ $show_customer_list ? 'Hide' : 'View' }} Customer List
            </button>
            <a href="{{ route('reservations.checkedout.print', ['period' => $search_period, 'reservations' => $reservations->toJson()]) }}" target="_blank" class="btn btn-primary">
                <i class="ti ti-printer me-1"></i> Print List
            </a>
        @endif
    </div>
    <hr class="my-2">
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table id="myTable" class="table">
                <thead class="table-light">
                    <tr>
                        <th>SN</th>
                        <th>Room</th>
                        <th>Category</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Reservation ID</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Occupancy Status</th>
                        <th>Early Check-in Fee</th>
                        <th>Late Check-out Fee</th>
                        <th>Total Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($reservations as $reservation)
                        <tr wire:key="{{ $reservation->id }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ Str::ucfirst(\App\Models\Room::where('id', $reservation->room_id)->value('name')) }}</td>
                            <td>{{ Str::ucfirst(\App\Models\Roomcategory::where('id', $reservation->category_id)->value('category')) }}</td>
                            <td>{{ $reservation->checkin }}</td>
                            <td>{{ $reservation->checkout }}</td>
                            <td>{{ $reservation->reservation_id }}</td>
                            <td>{{ $reservation->fullname }}</td>
                            <td>{{ $reservation->phone }}</td>
                            <td>{{ $reservation->email ?? 'N/A' }}</td>
                           <td><span class="badge bg-label-success me-1">{{ $reservation->checkout_status }}</span></td>
                            <td>₦{{ number_format($reservation->early_checkin_fee, 2) }}</td>
                            <td>₦{{ number_format($reservation->late_checkout_fee, 2) }}</td>
                            <td>₦{{ number_format($reservation->total_amount, 2) }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('view-receipt', ['reservation_id' => $reservation->reservation_id]) }}" target="_blank" class="dropdown-item">
                                            <i class="ti ti-printer me-1"></i> View Receipt
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Customer List -->
    @if($reservations->isNotEmpty() && $show_customer_list)
        <div class="card mt-4">
            <div class="card-header">
                <h5>Customers Checked Out {{ $search_period }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>SN</th>
                                <th>Room</th>
                                <th>Category</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Reservation ID</th>
                                <th>Customer</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Payment Status</th>
                                <th>Early Check-in Fee</th>
                                <th>Late Check-out Fee</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($reservations as $reservation)
                                <tr wire:key="list-{{ $reservation->id }}">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ Str::ucfirst(\App\Models\Room::where('id', $reservation->room_id)->value('name')) }}</td>
                                    <td>{{ Str::ucfirst(\App\Models\Roomcategory::where('id', $reservation->category_id)->value('category')) }}</td>
                                    <td>{{ $reservation->checkin }}</td>
                                    <td>{{ $reservation->checkout }}</td>
                                    <td>{{ $reservation->reservation_id }}</td>
                                    <td>{{ $reservation->fullname }}</td>
                                    <td>{{ $reservation->phone }}</td>
                                    <td>{{ $reservation->email ?? 'N/A' }}</td>
                                    <td>{{ Helper::get_reservation_payment_status($reservation->reservation_id) }}</td>
                                    <td>₦{{ number_format($reservation->early_checkin_fee, 2) }}</td>
                                    <td>₦{{ number_format($reservation->late_checkout_fee, 2) }}</td>
                                    <td>₦{{ number_format($reservation->total_amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
    <livewire:reservations.filtercheckedout-rooms>
</div>
