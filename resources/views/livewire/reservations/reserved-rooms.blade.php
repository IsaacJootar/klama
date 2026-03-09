<div>
    @php
      use Carbon\Carbon;
    @endphp
@php
    use App\Http\Helpers\Helper;
@endphp

     <div class="container-xxl flex-grow-1 container-p-y">
           <x-input-error-messages/>
             <!--/ page-label component -->
         <div>
             <x-home-page-label>These  are reserved room(s) for the current month of {{Carbon::now()->format('F, Y') }} </x-home-page-label>
         </div>
          <!--/ action button component -->

          <p class="my-2">
              <div class="col-12 d-flex gap-2 flex-wrap">
            <a href="{{ route('occupancy-list') }}" target="_blank" class="btn btn-primary"><i class="ti ti-printer me-1"></i> Print Occupancy List
            </a>
                            
            </div>
         <div class="card">
 
 <div class="table-responsive text-nowrap">
     <table id="myTable" class="table">
            <thead class="table-light">
                <tr>
                    <th>SN</th>
                    <th>Room</th>
                    <th>Category</th>
                    <th>Reservation ID</th>
                    <th>Customer</th>
                    <th>Checkin</th>
                    <th>CheckOut</th>
                    <th>Value</th>
                    <th>Total Amount</th>
                    <th>Payment Medium</th>
                    <th>Status</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Created time</th>
                    <th>Occupancy Status</th>
                    <th>State</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($reserved as $reserve)
                <tr wire:key='{{$reserve->id}}'>
                    <td>{{$loop->index + 1}}</td>
                    <td>{{Str::ucfirst($room = \App\Models\Room::where('id', $reserve->room_id)->value('name'))}}</td>
                    <td>{{str::ucfirst($room = \App\Models\Roomcategory::where('id', $reserve->category_id)->value('category'))}}</td>
                    <td>{{$reserve->reservation_id}}</td>
                    <td>{{$reserve->fullname}}</td>
                    <td>{{$reserve->checkin}}</td>
                    <td>{{$reserve->checkout}}</td>
                    <td>{{Helper::format_currency(\App\Models\Roomallocation::where('room_id', $reserve->room_id)->value('price'))}}</td>
                    <td>{{Helper::format_currency($reserve->total_amount)}}</td>
                    <td>{{$reserve->medium}}</td>
                    <td><span class="badge bg-label-primary me-1">{{$reserve->status}}</span></td>
                    <td>{{$reserve->address}}</td>
                    <td>{{$reserve->phone}}</td>
                    <td>{{$reserve->email}}</td>
                    <td>{{$reserve->created_at}}</td>
                     <td><span class="badge {{ $reserve->checkin_status == 'Pending' ? 'bg-label-secondary' : 'bg-label-success' }} me-1">
    {{ $reserve->checkin_status }}
</span>
</td>
                    <td><span class="badge bg-label-secondary me-1">{{$reserve->state}}</span></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                            <div class="dropdown-menu">
                                <a href="{{ route('view-receipt', ['reservation_id' => $reserve->reservation_id]) }}" target="_blank" class="dropdown-item">
                                    <i class="ti ti-printer me-1"></i> View Receipt
                                </a>
                                <a wire:click="confirmPayment('{{ $reserve->reservation_id }}', '{{ $reserve->email }}')" wire:confirm="Are you sure you want to proceed and confirm payment?" class="dropdown-item" href="javascript:void(0);">
                                    <i class="ti ti-check me-1"></i> Confirm this Payment
                                </a>
                                <a wire:click="cancelReservation('{{ $reserve->reservation_id }}')" wire:confirm="Are you sure you want to proceed and Cancel this Reservation?" class="dropdown-item" href="javascript:void(0);">
                                    <i class="ti ti-check me-1"></i> Cancel this Reservation
                                </a>
                                <a wire:click="swapRoom({{ $reserve->id }})" data-bs-toggle="modal" data-bs-target="#swapRoom" class="dropdown-item" href="javascript:void(0);"><i class="ti ti-reload me-1"></i> Swap This Room </a>
                                <a wire:click="extendReservation({{ $reserve->id }})" data-bs-toggle="modal" data-bs-target="#extendReservation" class="dropdown-item" href="javascript:void(0);"><i class="ti ti-calendar-plus me-1"></i> Extend Reservation </a>
                                <a wire:click="confirmCheckIn({{ $reserve->id }})" data-bs-toggle="modal" data-bs-target="#confirmCheckIn" class="dropdown-item" href="javascript:void(0);"><i class="ti ti-login me-1"></i> Confirm Check-In </a>
                                <a wire:click="confirmCheckOut({{ $reserve->id }})" data-bs-toggle="modal" data-bs-target="#confirmCheckOut" class="dropdown-item" href="javascript:void(0);"><i class="ti ti-logout me-1"></i> Confirm Check-Out </a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
                 </div>
           
           
           
          <!-- Confirm Check-In Modal -->
<div wire:ignore.self class="modal fade" data-bs-focus="false" id="confirmCheckIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-simple">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="mb-2"><x-home-page-label>CONFIRM CHECK-IN</x-home-page-label></h4>
                </div>
                <div>
                    <h6 class="mb-2"><strong>Reservation ID:</strong> ({{ $reservation_id }})</h6>
                    <h6 class="mb-2"><strong>Room:</strong> {{ Str::ucfirst(\App\Models\Room::where('id', $room_id)->value('name')) }}</h6>
                    <h6 class="mb-2"><strong>Room Value Per Night:</strong> ({{ Helper::format_currency(\App\Models\Roomallocation::where('room_id', $room_id)->value('price')) }})</h6>
                    <p class="mb-0">Please verify details and add a confirmation note before confirming check-in for this room.</p>
                    <div class="row g-5 py-8"></div>
                    <form>
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
                                    <td>{{ \App\Models\Reservation::where('reservation_id', $reservation_id)->where('room_id', $room_id)->value('fullname') }}</td>
                                    <td>{{ \App\Models\Reservation::where('reservation_id', $reservation_id)->where('room_id', $room_id)->value('phone') }}</td>
                                </tr>
                                <tr class="table-light">
                                    <th>Arrival Date</th>
                                    <th>Departure Date</th>
                                    <th>Operation Type</th>
                                </tr>
                                <tr>
                                    <td>{{ \App\Models\Reservation::where('reservation_id', $reservation_id)->where('room_id', $room_id)->value('checkin') }}</td>
                                    <td>{{ \App\Models\Reservation::where('reservation_id', $reservation_id)->where('room_id', $room_id)->value('checkout') }}</td>
                                    <td>Confirm Check-In</td>
                                </tr>
                            </tbody>
                        </table><br>
                        <form>
                            @csrf
                            <div class="col-12">
                                <label for="checkinType" class="form-label fw-bold">Check-In Type</label>
                                <select wire:model.live="checkin_type" class="form-select form-select-lg" id="checkinType" required>
                                    <option value="Standard">Standard</option>
                                    <option value="Early Check-In">Early Check-In</option>
                                </select>
                                @error('checkin_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div><br>
                            @if($checkin_type === 'Early Check-In')
                            <div class="col-12">
                                <label for="earlyCheckinFee" class="form-label fw-bold">Early Check-In Fee</label>
                                <div class="input-group input-group-merge">
                                    <input wire:model.live="early_checkin_fee" class="form-control form-control-lg" type="number" id="earlyCheckinFee" placeholder="Enter early check-in fee" min="0" step="0.01" required />
                                    <span class="input-group-text">NGN</span>
                                </div>
                                @error('early_checkin_fee') <span class="text-danger">{{ $message }}</span> @enderror
                            </div><br>
                            @endif
                            <div class="col-12">
                                <label for="confirmationNote" class="form-label fw-bold">Confirmation Note (e.g., items brought)</label>
                                <textarea wire:model="confirmation_note" class="form-control form-control-lg" id="confirmationNote" rows="4" placeholder="Enter details such as items brought by the customer" required></textarea>
                                @error('confirmation_note') <span class="text-danger">{{ $message }}</span> @enderror
                            </div><br>
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-primary" wire:click="saveCheckIn" wire:confirm="Are you sure you want to confirm check-in for this room?">
                                    Confirm Check-In
                                </button>
                            </div>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Confirm Check-In Modal -->

      <!-- Confirm Check-Out Modal -->
    <div wire:ignore.self class="modal fade" data-bs-focus="false" id="confirmCheckOut" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-simple">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2"><x-home-page-label>CONFIRM CHECK-OUT</x-home-page-label></h4>
                    </div>
                    <div>
                        <h6 class="mb-2"><strong>Reservation ID:</strong> ({{ $reservation_id }})</h6>
                        <h6 class="mb-2"><strong>Room:</strong> {{ Str::ucfirst(\App\Models\Room::where('id', $room_id)->value('name')) }}</h6>
                        <h6 class="mb-2"><strong>Room Value Per Night:</strong> ({{ Helper::format_currency(\App\Models\Roomallocation::where('room_id', $room_id)->value('price')) }})</h6>
                        <p class="mb-0">Please verify details and add a confirmation note before confirming check-out for this room.</p>
                        <div class="row g-5 py-8"></div>
                        <form>
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
                                        <td>{{ \App\Models\Reservation::where('reservation_id', $reservation_id)->where('room_id', $room_id)->value('fullname') }}</td>
                                        <td>{{ \App\Models\Reservation::where('reservation_id', $reservation_id)->where('room_id', $room_id)->value('phone') }}</td>
                                    </tr>
                                    <tr class="table-light">
                                        <th>Arrival Date</th>
                                        <th>Departure Date</th>
                                        <th>Operation Type</th>
                                    </tr>
                                    <tr>
                                        <td>{{ \App\Models\Reservation::where('reservation_id', $reservation_id)->where('room_id', $room_id)->value('checkin') }}</td>
                                        <td>{{ \App\Models\Reservation::where('reservation_id', $reservation_id)->where('room_id', $room_id)->value('checkout') }}</td>
                                        <td>Confirm Check-Out</td>
                                    </tr>
                                </tbody>
                            </table><br>
                            <form>
                                @csrf
                                <div class="col-12">
                                    <label for="checkoutType" class="form-label fw-bold">Check-Out Type</label>
                                    <select wire:model.live="checkout_type" class="form-select form-select-lg" id="checkoutType" required>
                                        <option value="Standard">Standard</option>
                                        <option value="Late Check-Out">Late Check-Out</option>
                                    </select>
                                    @error('checkout_type') <span class="text-danger">{{ $message }}</span> @enderror
                                </div><br>
                                @if($checkout_type === 'Late Check-Out')
                                <div class="col-12">
                                    <label for="lateCheckoutFee" class="form-label fw-bold">Late Check-Out Fee</label>
                                    <div class="input-group input-group-merge">
                                        <input wire:model.live="late_checkout_fee" class="form-control form-control-lg" type="number" id="lateCheckoutFee" placeholder="Enter late check-out fee" min="0" step="0.01" required />
                                        <span class="input-group-text">NGN</span>
                                    </div>
                                    @error('late_checkout_fee') <span class="text-danger">{{ $message }}</span> @enderror
                                </div><br>
                                @endif
                                <div class="col-12">
                                    <label for="confirmationNote" class="form-label fw-bold">Confirmation Note (e.g., room condition)</label>
                                    <textarea wire:model="confirmation_note" class="form-control form-control-lg" id="confirmationNote" rows="4" placeholder="Enter details such as room condition or items left" required></textarea>
                                    @error('confirmation_note') <span class="text-danger">{{ $message }}</span> @enderror
                                </div><br>
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-primary" wire:click="saveCheckOut" wire:confirm="Are you sure you want to confirm check-out for this room?">
                                        Confirm Check-Out
                                    </button>
                                </div>
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Confirm Check-Out Modal -->
    
            <!-- Swap Card -->

        <div  wire:ignore.self  class="modal fade" data-bs-focus="false" id="swapRoom" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered1 modal-simple modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-body">
                <button  type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="text-center mb-6">

                  <h4 class="mb-2"><x-home-page-label>{{'ROOM SWAP'}}</x-home-page-label></h4>
                </div>
                <div>
                  
                    <h6 class="mb-2"><strong> Reservation ID:</strong> ({{$reservation_id}})</h6>

                    <h6 class="mb-2"><strong> Room Value Per Night: </strong> ({{Helper::format_currency(\App\Models\Roomallocation::where('room_id', $room_id)->value('price'))}})</h6>




                    <p class="mb-0">Please verify before you initiate this swap.</p>
                    <div class="row g-5 py-8">

                    </div>
                    <form>


                            <table class="table">
                            <thead class="table-light">

                              <tr>
                                <th>Category</th>
                                <th>Customer</th>
                                <th>contact</th>


                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>{{(\App\Models\RoomCategory::where('id', $from_category_id)->get()->value('category'))}}</td>
                                <td>{{($fullname = \App\Models\Reservation::where('reservation_id', $reservation_id)->get()->value('fullname'))}}</td>
                                <td>{{(\App\Models\Reservation::where('reservation_id', $reservation_id)->get()->value('phone'))}}</td>


                              </tr>

                              <tr>



                              </tr>
                              <tr class="table-light">
                                <th>Room</th>
                                <th></th>
                                <th> Operation Type</th>




                              </tr>
                              <tr>
                                <td>
                                    {{Str::ucfirst($room = \App\Models\Room::where('id', $room_id)->value('name'))}}


                                </td>
                                <td></td>
                                <td>Room | Reservation Swap</td>


                              </tr>
                              <tr class="table-light">
                                <th>Arrival Date</th>
                                <th></th>
                                <th>Departure Date</th>
                              </tr>
                              <tr>
                                <td>{{($checkin = \App\Models\Reservation::where('reservation_id', $reservation_id)->get()->value('checkin'))}}</td>
                                <td></td>
                                <td>{{($checkout = \App\Models\Reservation::where('reservation_id', $reservation_id)->get()->value('checkout'))}}</td>


                              </tr>
                            </tbody>
                          </table><br>

 <form>
    @csrf

<br><label for="selectCat" class="form-label"> <strong><h6>Select Swap Type</h6></strong></label>
                          <select required wire:model="swap_type" class="form-select form-select-lg"
                            data-allow-clear="true">
                            <option value="">--Select System section--</option>
                            <option value="upgrade">Upgrade</option>
                            <option value="downgrade">Downgrade </option>
                            <option value="maintain">Maintain Value</option>

                        </select><br>

                        <label class="form-label w-100" >Enter Swap Value </label>
                        <div class="input-group input-group-merge">
                          <input disabled wire:model='new_value' class="form-control form-control-lg" type="text"  placeholder="Determined" />
                          <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
                        </div><br>






@php

// Get the current room price for comparison
$current_room_price = \App\Models\Roomallocation::where('room_id', $room_id)->value('price');


//  get rooms that are available begining from todayx excluding the room tobe swapped
//$checkin = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
//$checkout = Carbon::now()->timezone('Africa/Lagos')->addDays(1)->format('Y-m-d'); //working with dates sucks

$checkin = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
$checkout=Carbon::now()->timezone('Africa/Lagos')->addDays(1)->format('Y-m-d');
$rooms = \App\Models\Roomallocation::
    where(function ($query) use ($checkin, $checkout, $room_id) {
        $query->whereBetween('checkin', [$checkin, $checkout])
              ->whereBetween('checkout', [$checkin, $checkout])
              ->where('room_id', '!=', $room_id);
    })
    ->orWhere(function ($query) use ($room_id) {
        $query->where('checkin', '1986-09-01')
              ->where('room_id', '!=', $room_id); // Ensure room_id is excluded here too
    })
    ->orderBy('id', 'desc')
    ->get('room_id');


$checkin = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
$checkout=Carbon::now()->timezone('Africa/Lagos')->addDays(1)->format('Y-m-d');
$available = \App\Models\Roomallocation::
    where(function ($query) use ($checkin, $checkout, $room_id) {
        $query->whereBetween('checkin', [$checkin, $checkout])
              ->whereBetween('checkout', [$checkin, $checkout])
              ->where('room_id', '!=', $room_id);
    })
    ->orWhere(function ($query) use ($room_id) {
        $query->where('checkin', '1986-09-01')
              ->where('room_id', '!=', $room_id); // Ensure room_id is excluded here too
    })
    ->orderBy('id', 'desc')
    ->get('room_id');



@endphp


<div class="alert alert-outline-secondary" role="alert">
    <strong>Swap Effect: </strong> The following room(s) below, if any, are
    available today for you to swap into, however if any of the room to be swapped into is already
    reserved within these swap dates, the reservation on such a room will be
    cancelled. Please be aware that Swap Value will apply. Proceed with caution!<br /><br />
    
    @if($available->count() > 0)
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Room</th>
                        <th>Status</th>
                        <th>Swap Value</th>
                    </tr>
                </thead>
                <tbody>
                    
                 @foreach ($available as $avail)
    @php
        $room_name = \App\Models\Room::where('id', $avail->room_id)->value('name');
        $room_price = \App\Models\Roomallocation::where('room_id', $avail->room_id)->value('price');
        $price_difference = $room_price - $current_room_price;
       
    @endphp
    <tr>
        <td><strong>{{ $room_name }}</strong></td>
        <td>
           {{Helper::is_reserved($avail->room_id, $checkin)}}
        </td>
        <td>
            @if($price_difference > 0)
                <span class="text-success">
                    <i class="ti ti-arrow-up"></i>
                    Remit {{ Helper::format_currency($price_difference) }} to hotel
                </span>
            @elseif($price_difference < 0)
                <span class="text-danger">
                    <i class="ti ti-arrow-down"></i>
                    Remit {{ Helper::format_currency(abs($price_difference)) }} to customer
                </span>
            @else
                <span class="text-info">
                    <i class="ti ti-minus"></i>
                    Value is balanced
                </span>
            @endif
        </td>
    </tr>
@endforeach
                </tbody>
            </table>
        </div>
    @else
        <em>No rooms available for swap at this time.</em>
    @endif
</div>
<br><label for="selectCat" class="form-label"> <strong><h6>Select Swap Destination--</h6></strong></label>
<select required wire:model="swap_to_id" class="form-select form-select-lg" data-allow-clear="true">
    <option value="">--Select Room to Swap Into --</option>
    @foreach ($rooms as $room)
        @php
            $room_name = \App\Models\Room::where('id', $room->room_id)->value('name');
            $swap_to_id = \App\Models\Room::where('id', $room->room_id)->value('id');
            $room_status = Helper::is_reserved($room->room_id, $checkin);
            $status_text = strpos($room_status, 'Reserved') !== false ? 'Reserved' : 'Available';
        @endphp
        <option value="{{ $swap_to_id }}">{{ $room_name }} - ({{ $status_text }})</option>
    @endforeach
</select><br>



                  </div>

        <br>

        <input type="hidden" wire:model="swap_from_id" wire:ignore value="{{ $room_id }}">


                  <div class="col-12 text-center">
<button 
    type="button" 
    class="btn btn-primary"
    wire:click="save"
    wire:confirm="Are you sure you want to proceed with this swap?"
>
    Swap Room
</button>




            </form>
              </div>
            </div>
          </div>


        </div>
        <!--/ Swap Room Modal Card -->



             </div>
             <!--/ swaps rooms Rows -->

     </div>
     
     
     
     
<!-- Extend Reservation Modal -->
<div wire:ignore.self class="modal fade" data-bs-focus="false" id="extendReservation" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-simple modal-add-new-cc">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="mb-2"><x-home-page-label>ROOM EXTENSION</x-home-page-label></h4>
                </div>
                <div>
                    <h6 class="mb-2"><strong>Reservation ID:</strong> ({{ $reservation_id }})</h6>
                    <h6 class="mb-2"><strong>Room Value Per Night:</strong> ({{ Helper::format_currency(\App\Models\Roomallocation::where('room_id', $room_id)->value('price')) }})</h6>
                    <p class="mb-0">Please verify before you initiate this extension.</p>
                    <div class="row g-5 py-8"></div>
                    <form>
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
                                    <td>{{ \App\Models\Reservation::where('reservation_id', $reservation_id)->value('fullname') }}</td>
                                    <td>{{ \App\Models\Reservation::where('reservation_id', $reservation_id)->value('phone') }}</td>
                                </tr>
                                <tr class="table-light">
                                    <th>Room</th>
                                    <th></th>
                                    <th>Operation Type</th>
                                </tr>
                                <tr>
                                    <td>{{ Str::ucfirst(\App\Models\Room::where('id', $room_id)->value('name')) }}</td>
                                    <td></td>
                                    <td>Room | Extend Reservation</td>
                                </tr>
                                <tr class="table-light">
                                    <th>Arrival Date</th>
                                    <th></th>
                                    <th>Departure Date</th>
                                </tr>
                                <tr>
                                    <td>{{ \App\Models\Reservation::where('reservation_id', $reservation_id)->value('checkin') }}</td>
                                    <td></td>
                                    <td>{{ \App\Models\Reservation::where('reservation_id', $reservation_id)->value('checkout') }}</td>
                                </tr>
                            </tbody>
                        </table><br>
                        <form>
                            @csrf
                            <div class="col-5">
                                <label for="flatpickr-date2" class="form-label fw-bold">Select New Departure Date</label>
                                <input wire:model.live="new_checkout_date" class="form-control form-control-lg" placeholder="Select departure date" type="text" id="flatpickr-date2" required>
                            </div><br>
                            <div class="alert alert-outline-secondary" role="alert">
                                <strong>Extension Value:</strong> 
                                @if($extension_amount > 0)
                                    Additional amount due for the extension: <span class="badge bg-label-primary">{{ Helper::format_currency($extension_amount) }}</span>. 
                                    Please ensure funds are received before proceeding.
                                @else
                                    <span class="badge bg-label-secondary">Select a departure date after {{ session('original_checkout') ?? 'the current checkout' }} to calculate the amount due.</span>
                                @endif
                            </div>
                            <br>
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-primary" wire:click="saveExtension" wire:confirm="Are you sure you want to proceed with this extension?">
                                    Extend Reservation
                                </button>
                            </div>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Extend Reservation Modal -->
 </div>
