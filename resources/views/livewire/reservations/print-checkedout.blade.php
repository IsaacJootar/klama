@php
    use Illuminate\Support\Str;
@endphp

<style>
    .customer-list { margin-top: 20px; }
    .customer-list table { width: 100%; border-collapse: collapse; }
    .customer-list th, .customer-list td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    .customer-list th { background-color: #f2f2f2; }
    @media print {
        .customer-list { margin: 0; }
        a { display: none; }
    }
</style>

<div class="customer-list">
    <h1>Customers Checked Out {{ $period }}</h1>
    @if($reservations->isNotEmpty())
        <table>
            <thead>
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
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ Str::ucfirst(\App\Models\Room::where('id', $reservation->room_id)->value('name')) }}</td>
                        <td>{{ Str::ucfirst(\App\Models\Roomcategory::where('id', $reservation->category_id)->value('category')) }}</td>
                        <td>{{ $reservation->checkin }}</td>
                        <td>{{ $reservation->checkout }}</td>
                        <td>{{ $reservation->reservation_id }}</td>
                        <td>{{ $reservation->fullname }}</td>
                        <td>{{ $reservation->phone }}</td>
                        <td>{{ $reservation->email ?? 'N/A' }}</td>
                        <td>{{ \App\Http\Helpers\Helper::get_reservation_payment_status($reservation->reservation_id) }}</td>
                        <td>₦{{ number_format($reservation->early_checkin_fee, 2) }}</td>
                        <td>₦{{ number_format($reservation->late_checkout_fee, 2) }}</td>
                        <td>₦{{ number_format($reservation->total_amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No customers found for this period.</p>
    @endif
</div>

<script>
    window.onload = function() { window.print(); };
</script>