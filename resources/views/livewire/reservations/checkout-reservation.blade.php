<?php
use Carbon\Carbon;
use App\Http\Helpers\Helper;
?>

<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <section class="section-py bg-body first-section-pt">
            <div class="container">
                <div class="card px-3">
                    <div class="row">
                        <div class="col-lg-7 card-body border-end p-md-8">
                            <h4 class="mb-2"><strong>Confirm Reservation</strong> (ID: {{$reservation_id}})</h4>
                            <p class="mb-0">Please verify this reservation information before you complete your order.</p>
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
                                                <td>{{ \App\Models\Roomcategory::where('id', $category_id)->get()->value('category') }}</td>
                                                <td>{{ $fullname = \App\Models\Reservation::where('reservation_id', $reservation_id)->get()->value('fullname') }}</td>
                                                <td>{{ \App\Models\Reservation::where('reservation_id', $reservation_id)->get()->value('phone') }}</td>
                                            </tr>
                                            <tr class="table-light">
                                                <th>Email</th>
                                                <th>Channel</th>
                                                <th>Address</th>
                                            </tr>
                                            <tr>
                                                <td>{{ $email = \App\Models\Reservation::where('reservation_id', $reservation_id)->get()->value('email') }}</td>
                                                <td>{{ \App\Models\Reservation::where('reservation_id', $reservation_id)->get()->value('medium') }}</td>
                                                <td>{{ Str::of(\App\Models\Reservation::where('reservation_id', $reservation_id)->get()->value('address'))->limit(50) }}</td>
                                            </tr>
                                            <tr class="table-light">
                                                <th>Room(s)</th>
                                                <th></th>
                                                <th>Special Requests</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    @php
                                                    $Grouped = \App\Models\Reservation::select('category_id', DB::raw('count(*) as total_rooms'))
                                                        ->where('reservation_id', $reservation_id)
                                                        ->groupBy('category_id')
                                                        ->get();
                                                    $badgeClasses = ['bg-primary', 'bg-secondary', 'bg-dark'];
                                                    $i = 0;
                                                    foreach ($Grouped as $group) {
                                                        $categoryName = \App\Models\Roomcategory::where('id', $group->category_id)->value('category');
                                                        $badgeClass = $badgeClasses[$i % count($badgeClasses)];
                                                        echo "<span class=\"badge $badgeClass text-white me-1\">$categoryName Room(s): $group->total_rooms</span>";
                                                        $i++;
                                                    }
                                                    @endphp
                                                </td>
                                                <td></td>
                                                <td>{{ Str::of(\App\Models\Reservation::where('reservation_id', $reservation_id)->get()->value('requests'))->limit(50) }}</td>
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
                                    <input wire:model='couponCode' type="text" class="form-control" placeholder="Enter coupon Code" aria-label="Enter coupon Code">
                                    @error('couponCode') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-4 col-xxl-4 col-xl-12">
                                    <div class="d-grid">
                                        <button type="button" class="btn btn-label-primary" wire:click="applyCoupon">Apply  <x-app-loader /></button>
                                    </div>
                                </div>
                            </div>
                            @php
                            $couponCode = \App\Models\Reservation::where('reservation_id', $reservation_id)->value('coupon_code');
                            $totalDiscount = $couponCode ? \App\Models\Reservation::where('reservation_id', $reservation_id)->sum(DB::raw('('.\App\Models\Roomallocation::where('category_id', $category_id)->value('price') * Helper::get_number_of_days($checkin, $checkout).') - total_amount')) : 0;
                            @endphp
                            @if ($couponCode)
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0">Coupon ({{ $couponCode }})</p>
                                    <h6 class="mb-0">-{{ Helper::format_currency($totalDiscount) }}</h6>
                                </div>
                            @endif
                            <div class="bg-lighter p-6 rounded">
                                <p>
                                    <h4>{{ \App\Models\Roomcategory::where('id', $category_id)->get()->value('category') }}</h4>
                                </p>
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="text-heading mb-0">{{ Helper::format_currency($price = \App\Models\Roomallocation::where('category_id', $category_id)->get()->value('price')) }}</h4>
                                    <sub class="h6 text-body mb-n3">/Night</sub>
                                </div>
                                <div class="d-grid">
                                    @php
                                    $nor = \App\Models\Reservation::where('reservation_id', $reservation_id)->get()->value('nor');
                                    $categoryCount = \App\Models\Reservation::where('reservation_id', $reservation_id)
                                        ->distinct('category_id')
                                        ->count('category_id');
                                    @endphp
                                    @if ($categoryCount <= 1)
                                        <a href="{{ route('update-reservation', ['reservation_id' => $reservation_id]) }}" type="button" class="btn btn-label-primary">Edit Reservation</a>
                                    @endif
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
                                if (is_null($email)) {
                                    $email = 'vinegrouphouse@gmail.com';
                                }
                                $amount = \App\Models\Reservation::where('reservation_id', $this->reservation_id)->sum('total_amount') * 100;
                                $reservation_id = $reservation_id;
                                $reference = Paystack::genTranxRef();
                                @endphp
                                  {{--
                                <div class="d-grid mt-5">
                                  
                                        <a href="{{ route('pay', ['amount' => $amount, 'email' => $email, 'reference' => $reservation_id, 'orderID' => $reservation_id]) }}">
                                            <button class="btn btn-success">
                                                <span style="color: white" class="me-2">Payment Online Now</span>
                                            </button>
                                        </a>
                                  

                                </div>
                                  --}}
                                <div class="d-grid mt-5">
                                    <button id="btnGroupDrop1" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span style="color: white" class="me-2">Offline Payment</span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <h6 class="mb-0"><i class="badge bg-label-warning ms-1">Make sure payment is received before you confirm!</i></h6>
                                        <div class="d-grid mt-5">
                                            <label for="largeSelect" class="form-label"><strong>Select Receiving Bank</strong></label>
                                            <select wire:model="receiving_bank" id="largeSelect" class="form-select form-select-lg">
                                                <option value="">--Select Bank--</option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                                @endforeach
                                            </select>
                                            <hr class="my-2">
                                            <a wire:click="comfirmPayment('{{ $reservation_id }}', '{{ $email }}')"
                                               wire:confirm="Are you sure you want to proceed and confirm this payment?">
                                                <button class="btn btn-success">
                                                    <span style="color: white" class="me-2">Confirm this Payment</span>
                                                </button>
                                            </a>
                                            <x-app-loader />
                                        </div>
                                    </ul>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>