<?php
use Carbon\Carbon;
use App\Http\Helpers\Helper;
?>

<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Checkout Sections: Starts -->
        <section class="section-py bg-body first-section-pt">
            <div class="container">
                <div class="card px-3">
                    <div class="row">
                        <div class="col-lg-7 card-body border-end p-md-8">
                            <h4 class="mb-2"><strong>Confirm Reservation</strong> (ID: {{$reservation_id}})</h4>
                            <p class="mb-0">Please verify this reservation informations before you complete your order.</p>
                            <div class="row g-5 py-8"></div>
                            <form>
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Category</th>
                                                <th>Customer</th>
                                                <th>Contact</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ \App\Models\Roomcategory::where('id', $category_id)->value('category') }}</td>
                                                <td>{{ $fullname = \App\Models\Reservation::where('reservation_id', $reservation_id)->value('fullname') }}</td>
                                                <td>{{ \App\Models\Reservation::where('reservation_id', $reservation_id)->value('phone') }}</td>
                                            </tr>
                                            <tr class="table-light">
                                                <th>Email</th>
                                                <th>Channel</th>
                                                <th>Address</th>
                                            </tr>
                                            <tr>
                                                <td>{{ $email = \App\Models\Reservation::where('reservation_id', $reservation_id)->value('email') }}</td>
                                                <td>{{ \App\Models\Reservation::where('reservation_id', $reservation_id)->value('medium') }}</td>
                                                <td>{{ Str::of(\App\Models\Reservation::where('reservation_id', $reservation_id)->value('address'))->limit(50) }}</td>
                                            </tr>
                                            <tr class="table-light">
                                                <th>Room(s)</th>
                                                <th></th>
                                                <th>Special Requests</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    @foreach ($rooms as $room)
                                                        {{ $room->name }} .
                                                    @endforeach
                                                </td>
                                                <td></td>
                                                <td>{{ Str::of(\App\Models\Reservation::where('reservation_id', $reservation_id)->value('requests'))->limit(50) }}</td>
                                            </tr>
                                            <tr class="table-light">
                                                <th>Arrival Date</th>
                                                <th></th>
                                                <th>Departure Date</th>
                                            </tr>
                                            <tr>
                                                <td>{{ Carbon::parse($checkin)->format('l jS \ F Y') }}</td>
                                                <td></td>
                                                <td>{{ Carbon::parse($checkout)->format('l jS \ F Y') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-5 card-body p-md-8">
                            <h4 class="mb-2">Order Summary</h4>
                            <p>
                                <i class="badge bg-label-success ms-1">
                                    @php echo Carbon::now()->format('l jS \ F Y'); @endphp
                                </i>
                            </p>
                            <p class="mb-8">You can use the edit reservation if you wish to make changes before payment.</p>
                            <h6>Coupon Offer</h6>
                            <div class="row g-4 mb-4">
                                <div class="col-8 col-xxl-8 col-xl-12">
                                    <input wire:model="couponCode" type="text" class="form-control" placeholder="Enter coupon Code" aria-label="Enter coupon Code">
                                    @error('couponCode') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-4 col-xxl-4 col-xl-12">
                                    <div class="d-grid">
                                    <button type="button" class="btn btn-label-primary" wire:click="applyCoupon" wire:loading.attr="disabled">
    Apply

    <!-- This shows the loader ONLY when `applyCoupon` is running -->
    <x-app-loader wire:loading wire:target="applyCoupon" class="ms-2"/>
</button>

                                    </div>
                                </div>
                            </div>
                            <div class="bg-lighter p-6 rounded">
                                <p><h4>{{ \App\Models\Roomcategory::where('id', $category_id)->value('category') }}</h4></p>
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="text-heading mb-0">{{ Helper::format_currency($price = \App\Models\Roomallocation::where('category_id', $category_id)->value('price')) }}</h4>
                                    <sub class="h6 text-body mb-n3">/Night</sub>
                                </div>
                                <div class="d-grid">
                                    @php
                                    $nor = \App\Models\Reservation::where('reservation_id', $reservation_id)->value('nor');
                                    @endphp
                                    <a href="{{ route('update-booking', ['reservation_id' => $reservation_id]) }}" type="button" class="btn btn-label-primary">Edit Reservation</a>
                                </div>
                            </div>
                            <div class="mt-5">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0">Quantity</p>
                                    <h6 class="mb-0">{{ $nor }} Room(s)</h6>
                                </div>
                                <p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0">Duration</p>
                                    <h6 class="mb-0">{{ Helper::get_number_of_days($checkin, $checkout) }} Night(s)</h6>
                                </div>
                                <p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0">Subtotal</p>
                                    <h6 class="mb-0">{{ Helper::get_total_amount_due($checkin, $checkout, $category_id, $nor) }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <p class="mb-0">Tax</p>
                                    <h6 class="mb-0"><i class="badge bg-label-success ms-1">inclusive</i></h6>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center mt-4 pb-1">
                                    <p class="mb-0"><strong>Total</strong></p>
                                    <h6 class="mb-0">{{ Helper::format_currency(\App\Models\Reservation::where('reservation_id', $reservation_id)->sum('total_amount')) }}</h6>
                                </div>
                                @php
                                $couponCode = \App\Models\Reservation::where('reservation_id', $reservation_id)->value('coupon_code');
                                $totalDiscount = $couponCode ? \App\Models\Reservation::where('reservation_id', $reservation_id)->sum(DB::raw('('.\App\Models\Roomallocation::where('category_id', $category_id)->value('price') * Helper::get_number_of_days($checkin, $checkout).') - total_amount')) : 0;
                                @endphp
                                @if ($couponCode)
                                    <div class="d-flex justify-content-end mt-2">
                                        <small><strong style="color: #28a745;">Coupon ({{ $couponCode }}) -{{ Helper::format_currency($totalDiscount) }}</strong></small>
                                    </div>
                                @endif
                                @php
                                if (is_null($email)) {
                                    $email = 'vinegrouphouse@gmail.com';
                                }
                                $amount = \App\Models\Reservation::where('reservation_id', $reservation_id)->sum('total_amount') * 100;
                                $reservation_id = $reservation_id;
                                $reference = Paystack::genTranxRef();
                                @endphp
                                <div class="d-grid mt-5">
                                    <a href="{{ route('pay', ['amount' => $amount, 'email' => $email, 'reference' => $reservation_id, 'orderID' => $reservation_id]) }}">
                                        <button class="btn btn-success">
                                            <span style="color: white" class="me-2">Payment Online Now</span>
                                        </button>
                                    </a>
                                </div>
                                <x-privacy-check />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>