<div>
    @php
      use Carbon\Carbon;
    @endphp

@php
    use App\Http\Helpers\Helper;
@endphp
     <div class="container-xxl flex-grow-1 container-p-y">
             <!--/ page-label component -->
         <div>
             <x-home-page-label>These  are rooms due for checkouts as at today {{Carbon::now()->timezone('Africa/Lagos')->format('l, jS \ F, Y')}}</x-home-page-label>
         </div>
          <!--/ action button component -->
          <div>
            <x-modal-home-create-plain-button data-bs-target="#filterDueDate"> <i
                class="ti ti-search me-1"></i> Filter Due Dates</x-modal-home-create-plain-button>
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
                              <th>Checkin</th>
                                <th>CheckOut</th>

                             <th>Reservation ID</th>

                               <th>Customer</th>

                                 <th>Phone</th>
                                  <th>Email</th>


                           <th>Occupancy  Status</th>
                           <th>Action</th>

                         </tr>
                     </thead>
                         <tbody class="table-border-bottom-0">
                             @foreach($reservations as $reservation)


                             <tr wire:key='{{$reservation->id}}'>

                                 <td>{{$loop->index + 1}}</td>
                                 <td>{{Str::ucfirst($room = \App\Models\Room::where('id', $reservation->room_id)->value('name'))}}
                                </td>

<<<<<<< HEAD
                                <td>{{str::ucfirst($room = \App\Models\Roomcategory::where('id', $reservation->category_id)->value('category'))}}
=======
                                <td>{{str::ucfirst($room = \App\Models\RoomCategory::where('id', $reservation->category_id)->value('category'))}}
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
                                </td>
                                <td>    {{$reservation->checkin}}</td>
                                <td>    {{$reservation->checkout}}</td>
                                 <td>    {{$reservation->reservation_id}}</td>

                                <td>   {{$reservation->fullname}}</td>

                                <td>   {{$reservation->phone}}</td>
                                <td>   {{$reservation->email}}</td>

                               <td><span class="badge bg-label-success me-1">{{ $reservation->checkout_status }}</span></td>
                                 <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                        <div class="dropdown-menu">

                                           <a wire:click="confirmCheckOut({{ $reservation->id }})" data-bs-toggle="modal" data-bs-target="#confirmCheckOut" class="dropdown-item" href="javascript:void(0);"><i class="ti ti-logout me-1"></i>Comfirm CheckOut </a>
                                                    
                                            <a href="{{ route('view-receipt', ['reservation_id' => $reservation->reservation_id]) }}"
                                           target="_blank"
                                           class="dropdown-item">
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
             <!--/ Reserved rooms Rows -->
             
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
                                    {{-- Ensure $category_id is passed to the component or initialized to avoid errors --}}
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


     </div>
     <livewire:reservations.filter-due-rooms>
 </div>
