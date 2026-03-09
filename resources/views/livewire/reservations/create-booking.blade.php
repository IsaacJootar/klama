<div>
    @php
        use Carbon\Carbon;
    @endphp

    <!-- Content -->
    <x-input-error-messages/>

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row invoice-preview">

            <!-- Creat Reservation -->
            <div class="col-xl-8 col-md-8">
                <div class="card invoice-preview-card p-sm-12 p-6">




                    <div class="alert alert-secondary alert-dismissible d-flex" role="alert">
                        <span class="alert-icon rounded">
                            <i class="ti ti-bookmark"></i>
                        </span>
                        <div class="d-flex flex-column ps-1">
                            <h5 class="alert-heading mb-2">Reservation Form: Please fill Appropriately!</h5>
                            Arrival Date:
                            @php
                                echo Carbon::parse($checkin)->format('l jS \ F Y'); // from mount
                                echo ' - ';
                                echo 'Departure Date:';
                                echo Carbon::parse($checkout)->format('l jS \ F Y');
                                echo '<p>';

                            @endphp

                            <p class="mb-0"><strong>Note:</strong> that all special requests are subject to
                                availability and additional charges may apply.</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    </div>


                    <form onSubmit="return false">
                        @csrf

                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label class="form-label" for="name-modern-vertical">Number of Rooms</label>
                                    <select id="name-modern-vertical" required wire:model='nor'
                                        class="form-control form-control-lg" id="exampleSelectBorder">
                                        @for ($i = 1; $i <= $nor; $i++)
                                            <option>{{ $i }}</option>
                                        @endfor

                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <label class="form-label" for="name-modern-vertical"><strong style="color: red">*
                                    </strong>Customer Name</label>
                                <input wire:model="fullname" type="text" id="name-modern-vertical"
                                    class="form-control form-control-lg" placeholder="Enter..." />
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label" for="name-modern-vertical"><strong style="color: red">*
                                    </strong>Contact Number</label>
                                <input wire:model="phone" type="text" id="name-modern-vertical"
                                    class="form-control form-control-lg" placeholder="Enter..." />
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="name-modern-vertical">Customer Email</label>
                                <input wire:model="email" type="email" id="name-modern-vertical"
                                    class="form-control form-control-lg" placeholder="enter..." />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label class="form-label" for="name-modern-vertical">Customer Address</label>
                                    <textarea wire:model='address' class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="name-modern-vertical">Any Special Resquests?</label>
                                    <textarea wire:model='requests' name="requests" class="form-control" rows="3"
                                        placeholder="E.g:  I want an arranged Pickup from the airport"></textarea>
                                    <input name="category_id" value="{{ $category_id }}" style="visibility: hidden">
                                    <input wire:model='medium' style="visibility: hidden">
                                    <input wire:model='checkin' value="{{ $checkin }}" style="visibility: hidden">
                                    <input wire:model='checkout' value="{{ $checkout }}" style="visibility: hidden">



                                </div>

                            </div>

                        </div>


                        <div class="col-sm-6">
                            <button wire:click='store' class="btn btn-secondary">Comfirm Reservation </button>
                            <x-app-loader />
                        </div>




                    </form>

                </div>

                <hr class="mt-0 mb-6">
            </div>
            <!-- /reservation-form  -->

            <div class="col-xl-4 col-md-4 col-12 invoice-actions">
                <div class="card">
                    <div class="card-body">
                        @foreach ($allocations as $allocation)
                            <h4 class="card-title"> <span class="badge bg-label-secondary">
                                    {{ $allocation->category->category }}</span></h4>
                            <h6 class="card-title">
                                {{ $count = \App\Models\Roomallocation::where('category_id', $allocation->category->id)->whereNotBetween('checkin', [$checkin, $checkout])->whereNotBetween('checkout', [$checkin, $checkout])->get()->count() }}
                                Available Room (s) </h6>
                            <p class="card-text">
                                {{ $allocation->category->details }}

                            </p>
                            <br />
                            <h6 class="mb-1">Special Offers</h6>
                            <!-- Specials-make this dynamic later and allow managers add at will -->
                            <p>
                            <ul
                                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 my-2">
                                <li class="list-inline-item d-flex gap-2 align-items-center">
                                    @php
                                        if ($allocation->category->wifi == 1) {
                                            echo '<i class="fas fa-wifi"></i>' . ' <span class="fw-medium">WiFi</span>';
                                        }
                                    @endphp
                                </li>
                                <li class="list-inline-item d-flex gap-2 align-items-center">
                                    @php
                                        if ($allocation->category->breakfast == 1) {
                                            echo '<i class="fas fa-coffee"></i>' . ' <span class="fw-medium">Breakfast</span>';
                                        }
                                    @endphp
                                </li>
                                <li class="list-inline-item d-flex gap-2 align-items-center">
                                    @php
                                        if ($allocation->category->lunch == 1) {
                                            echo '<i class="fas fa-concierge-bell"></i>' . ' <span class="fw-medium">Lunch</span>';
                                        }
                                    @endphp
                                </li>
                                <li class="list-inline-item d-flex gap-2 align-items-center">
                                    @php
                                        if ($allocation->category->laundry == 1) {
                                            echo '<i class="fas fa-tshirt"></i>' . ' <span class="fw-medium">Laundry </span>';
                                        }
                                    @endphp
                                </li>



                            </ul>
                            </p>


                            </p> <br />
                            <h6 class="mb-1">Price:
                                {{ Helper::format_currency(\App\Models\Roomallocation::where('category_id', $allocation->category_id)->get()->value('price')) }}
                                <h6 class="mb-1">Per Night (Inc. Tax ) </h6>
                            </h6> <br />
                        @endforeach

            <!-- Hotel Reservation Guidelines & policies: these will have a model tablein databse. as part of setup & configs  -->
                        <h6 class="alert-heading mb-1"><x-page-label-secondary> Reservation
                                Policies</x-page-label-secondary></h6>
                        <ul class="list-unstyled mb-0">

                            <li> <span class="badge badge-dot bg-secondary me-1"></span>Unpaid reservation
                                must be confirmed 24 hours prior to arrival by making full payment </li>
                            <li> <span class="badge badge-dot bg-secondary me-1"></span> Please note that all special
                                requests are subject to availability and additional charges may apply</li>
                            <li> <span class="badge badge-dot bg-secondary me-1"></span>All non-standard rates requires
                                full pre-payment at the time of the booking and are non refundable nor transferable</li>

                            <li> <span class="badge badge-dot bg-secondary me-1"></span>Confirmed reservations are non
                                refundable nor transferable</li>

                        </ul>

                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
        </div>

    </div>
</div>
