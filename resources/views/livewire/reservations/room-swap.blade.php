<div>
    @php
      use Carbon\Carbon;
    @endphp
<<<<<<< HEAD
@php
    use App\Http\Helpers\Helper;
@endphp
=======

>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa

     <div class="container-xxl flex-grow-1 container-p-y">
             <!--/ page-label component -->
         <div>
<<<<<<< HEAD
             <x-home-page-label>These  are Swapped room(s) for the Current Month of {{Carbon::now()->format('F, Y') }} </x-home-page-label>
=======
             <x-home-page-label>These  are swaps room(s) as at recently </x-home-page-label>
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
         </div>
          <!--/ action button component -->

          <p class="my-2">
         <div class="card">

 <div class="table-responsive text-nowrap">
     <table class="table">
       <thead class="table-light">

                         <tr>
                             <th>SN</th>
<<<<<<< HEAD
                               <th>swapped By</th>
                             <th>Type of Room Swap </th>
                             <th>Swapped From</th>
                              <th>Swapped To</th>
                             <th>Swapped From Category</th>
                              <th>Swapped To Category</th>
                             <th> Reservation ID (Swapped From)</th>
                              <th> Reservation ID (Swapped To)</th>
                             <th>Customer (Swapped From)</th>
                             <th>Customer (Swapped To)</th>
                             <th>Phone (Swapped To)</th>
                             <th>Email (Swapped To)</th>
                           
                             <th>Swap Value</th>
=======
                             <th>Room</th>
                             <th>Category</th>
                             <th>Reservation ID</th>
                             <th>Customer</th>
                              <th>Checkin</th>
                                <th>CheckOut</th>
                             <th>Value</th>

                               <th>Payment Medium</th>
                              <th>Status</th>


                                 <th>Phone</th>
                                 <th>Email</th>

                           <th>Payment Status</th>
                           <th>Action</th>

>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
                         </tr>
                     </thead>
                         <tbody class="table-border-bottom-0">
                             @foreach ($swaps as $swap)


                             <tr wire:key='{{$swap->id}}'>

                                 <td>{{$loop->index + 1}}</td>
<<<<<<< HEAD
                                 <td>{{Str::ucfirst(\App\Models\User::where('id', $swap->user_id)->value('name'))}}
                                </td>

                               <td>{{$swap->swap_type}}</td>
                                <td>{{Str::ucfirst(\App\Models\Room::where('id', $swap->swap_from_id)->value('name'))}}</td>
                                  <td>{{Str::ucfirst(\App\Models\Room::where('id', $swap->swap_to_id)->value('name'))}}</td>
                           
                                <td>{{Str::ucfirst(\App\Models\Roomcategory::where('id', $swap->from_category_id)->value('category'))}}</td>
                                 <td>{{Str::ucfirst(\App\Models\Roomcategory::where('id', $swap->to_category_id)->value('category'))}}</td>
                                <td>{{$swap->from_reservation_id ?? 'N/A'}}</td>
                                <td>{{$swap->to_reservation_id ?? 'N/A'}}</td>
                                <td>{{$swap->customer ?? 'N/A'}}</td>
                                <td>{{$swap->to_customer ?? 'N/A'}}</td>
                                <td>{{$swap->to_phone ?? 'N/A'}}</td>
                                <td>{{$swap->to_email ?? 'N/A'}}</td>
                                <td>{{Helper::format_currency($swap->new_value)}}</td>
=======
                                 <td>{{Str::ucfirst($room = \App\Models\Room::where('id', $swap->room_id)->value('name'))}}
                                </td>

                                <td>{{str::ucfirst($room = \App\Models\Roomcategory::where('id', $swap->category_id)->value('category'))}}
                                </td>
                                <td>    {{$swap->reservation_id}}</td>
                                <td>   {{$swap->fullname}}</td>
                                <td>    {{$swap->checkin}}</td>
                                <td>    {{$swap->checkout}}</td>
                                <td>    {{Helper::format_currency(\App\Models\Roomallocation::where('room_id', $swap->room_id)->value('price'))}}</td>

                                <td>    {{$swap->medium}}</td>
                                <td><span class="badge bg-label-primary me-1">swaps</span></td>


                                <td>   {{$swap->phone}}</td>
                                <td>   {{$swap->email}}</td>

                                 <td>{{Helper::get_reservation_payment_status($swap->reservation_id)}}</td>
                                 <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                            <div class="dropdown-menu">
                                                <a wire:click="swap({{ $swap->id }})" data-bs-toggle="modal" data-bs-target="#swapRoom" class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ti ti-reload me-1"></i> Swap This Room </a>

                                            </div>
                                        </div>
                                    </td>
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div>



<<<<<<< HEAD
       
=======
        <!-- Add New Fleet Item -->

        <div  wire:ignore.self  class="modal fade" data-bs-focus="false" id="swapRoom" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered1 modal-simple modal-add-new-cc">
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
                                <td>{{(\App\Models\RoomCategory::where('id', $category_id)->get()->value('category'))}}</td>
                                <td>{{($fullname = \App\Models\Reservation::where('reservation_id', $reservation_id)->get()->value('fullname'))}}</td>
                                <td>{{(\App\Models\Reservation::where('reservation_id', $reservation_id)->get()->value('phone'))}}</td>


                              </tr>

                              <tr>



                              </tr>
                              <tr class="table-light">
                                <th>Room(s)</th>
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
                          <script>
                            function toggleTextbox() {
                                // Hide all textboxes initially
                                document.getElementById("upgradeTextbox").style.display = "none";
                                document.getElementById("downgradeTextbox").style.display = "none";
                                document.getElementById("maintainTextbox").style.display = "none";

                                // Get selected radio button value
                                let selectedValue = document.querySelector('input[name="valueOption"]:checked').value;

                                // Show the corresponding textbox
                                if (selectedValue === "upgrade") {
                                    document.getElementById("upgradeTextbox").style.display = "block";
                                } else if (selectedValue === "downgrade") {
                                    document.getElementById("downgradeTextbox").style.display = "block";
                                } else if (selectedValue === "maintain") {
                                    document.getElementById("maintainTextbox").style.display = "block";
                                }
                            }
                        </script>

    <style>
        .textbox {
            display: none; /* Hide textboxes initially */
            margin-top: 10px;
        }
    </style>
 <form>
    @csrf

<label for="selectCat" class="form-label"> <strong><h6>Select Type of Swap</h6></strong></label>

<div style="display: flex; gap: 15px; align-items: center;">
    <label>
        <input type="radio" name="valueOption" value="upgrade" onclick="toggleTextbox()"> Upgrade Value
    </label>
    <label>
        <input type="radio" name="valueOption" value="downgrade" onclick="toggleTextbox()"> Downgrade Value
    </label>
    <label>
        <input type="radio" name="valueOption" value="maintain" onclick="toggleTextbox()"> Maintain Value
    </label>
</div><br>

    <input type="text"  wire:model='upgrade' id="upgradeTextbox" class="textbox" placeholder="Enter upgrade value">
    <input type="text" wire:model='downgrade' id="downgradeTextbox" class="textbox" placeholder="Enter downgrade value">
    <input  type="text"  readonly wire:model='maintain' value="{{\App\Models\Roomallocation::where('room_id', $room_id)->value('price')}}" id="maintainTextbox" class="textbox">
<br/>


@php
//  get rooms that are available begining from todayx excluding the room tobe swapped
//$checkin = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
//$checkout = Carbon::now()->timezone('Africa/Lagos')->addDays(1)->format('Y-m-d'); //working with dates sucks

$checkin = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
$checkout=Carbon::now()->timezone('Africa/Lagos')->addDays(1)->format('Y-m-d');
$rooms = \App\Models\Roomallocation::whereNotBetween('checkin', [$checkin, $checkout])
                                        ->where('room_id', '!=',$room_id)
                                        ->whereNotBetween('checkout', [$checkin, $checkout] )
                                        ->orderBy('id', 'desc')->get('room_id');


            $checkin = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
            $checkout=Carbon::now()->timezone('Africa/Lagos')->addDays(1)->format('Y-m-d');
$available = \App\Models\Roomallocation::whereNotBetween('checkin', [$checkin, $checkout])
                                        ->where('room_id', '!=',$room_id)
                                        ->whereNotBetween('checkout', [$checkin, $checkout] )
                                        ->orderBy('id', 'desc')->get('room_id');


@endphp


<div class="alert alert-outline-secondary" role="alert">
    <strong>Swap Effect: </strong> The following room(s) below, if any, are available today for you to swap to, however if any of the rooms is already reserved within the swap dates, then the reservation(s) on such room(s) will be cancelled! <br/>
    @foreach ($available   as $avail )


    <strong>
        {{$avail_room =\App\Models\Room::where('id', $avail->room_id)->value('name');}}
        {{Helper::is_reserved($avail->room_id, $checkin)}}
    </strong>

        @endforeach
  </div>




<br><label for="selectCat" class="form-label"> <strong><h6>Select Swap Destination--</h6></strong></label>
                          <select required wire:model="swap_to" class="form-select form-select-lg"
                            data-allow-clear="true">
                            <option  value="">--Select Room to Swap Into --</option>
                            @foreach ($rooms  as $room)



                           {{$room_name =\App\Models\Room::where('id', $room->room_id)->value('name');}}


                            <option value="{{$room_name}}">{{$room_name}}</option>
                            @endforeach<br>
                        </select><br>


                    </form>
                  </div>

        <br>
                  <div class="col-12 text-center">

                    <button
                    wire:confirm="Are you sure you want to proceed with this swap?"
                    wire:click='save' type="button" class="btn btn-primary">{{ 'Swap Room' }}</button>
                    <button

                    type="button" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    <x-app-loader/>
                  </div>
                </form>
              </div>
            </div>
          </div>


        </div>
        <!--/ New Swap Room Modal -->
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa

             </div>
             <!--/ swaps rooms Rows -->

     </div>
 </div>
