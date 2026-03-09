<div>
    @php
        use Illuminate\Support\Str;
        use Carbon\Carbon;
    @endphp

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
 <div>
            <x-home-page-label>These  are available reservation feeds for today {{Carbon::now()->format('l, jS \ F, Y')}}</x-home-page-label>
        </div><br>

        <div class="row">
            <!-- Reservations Feeds-->
            <div class="col-xl-6 mb-6 mb-xl-0">
                <div class="card">
                    <h5 class="card-header">Reservation Feeds</h5>
                    <hr class="my-1">
                    <div class="card-body">

                        <ul class="timeline mb-0">
                            @foreach ($reserved as $reserve)
                                <li class="timeline-item timeline-item-transparent">

                                    <span class="timeline-point timeline-point-primary"></span>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-3" wire:key='{{ $reserve->id }}'>
                                            <h6 class="mb-0">

                                                {{ str::ucfirst(\App\Models\Roomcategory::where('id', $reserve->category_id)->value('category')) }}
                                                <strong>
                                                    {{ Str::ucfirst(\App\Models\Room::where('id', $reserve->room_id)->value('name')) }}</strong>
                                                    <small class="text-muted"><i class="badge bg-label-success ms-1">  Reserved</i></h6>
                                                    </small>
                                            <small class="text-muted">
                                                @php
                                            echo  Carbon::parse($reserve->created_at)->diffForHumans();
                                                @endphp
                                            </small>
                                        </div>
                                        <p class="mb-2">
                                            <small class="text-muted"> Reservation Channel:
                                                <i class="badge bg-label-success ms-1"> {{ $reserve->medium }}</i></span>
                                            </small>
                                        </p>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="badge bg-lighter rounded d-flex align-items-center">
                                                <img src="../../assets/img/icons/misc/pdf.png" alt="img"
                                                    width="12" class="me-1">
                                                <span class="h6 mb-0 text-body">Receipt</span>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                            </li>

                        </ul>
                    </div>

                </div>

            </div>

            <!-- /Reservations feeds -->

            <!-- Room Checkouts Feeds-->
            <div class="col-xl-6">
                <div class="card">
                    <h5 class="card-header">Checkout Feeds</h5>
                    <hr class="my-1">
                    <div class="card-body">
                        <ul class="timeline mb-0">
                            @foreach ($checkouts as $checkout)
                            <li class="timeline-item timeline-item-transparent border-left-dashed">

                                    <span class="timeline-point timeline-point-warning"></span>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-3" wire:key='{{ $checkout->id }}'>
                                            <h6 class="mb-0">

                                                {{ str::ucfirst(\App\Models\Roomcategory::where('id', $checkout->category_id)->value('category')) }}
                                                <strong>
                                                    {{ Str::ucfirst(\App\Models\Room::where('id', $checkout->room_id)->value('name')) }}</strong>
                                                    <small class="text-muted"><i class="badge bg-label-info ms-1">  Checked Out</i></h6>
                                                    </small>
                                            <small class="text-muted">
                                                @php
                                            echo  Carbon::parse($checkout->updated_at)->diffForHumans();
                                                @endphp
                                            </small>
                                        </div>
                                        <p class="mb-2">
                                            <small class="text-muted"> Reservation Channel:
                                                <i class="badge bg-label-info ms-1"> {{ $checkout->medium }}</i></span>
                                            </small>
                                        </p>

                                    </div>
                            @endforeach
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Checkouts Feeds-->
        </div>


    </div>
    <!-- / Feeds Content -->
</div>
