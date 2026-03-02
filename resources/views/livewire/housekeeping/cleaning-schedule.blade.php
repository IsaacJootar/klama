<div>    @php
             use Carbon\Carbon;
            {{$date = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');}}

            @endphp
    <x-input-error-messages/>

    <div class="container-xxl flex-grow-1 container-p-y">
            <!--/ page-label component -->
        <div>
            <x-home-page-label>Create, update and delete Housekeeping Here </x-home-page-label>
        </div>
         <!--/ action button component -->
    <div>
        <x-modal-home-create-button  data-bs-target="#addAsset">Add Cleaning Schedule </x-modal-home-create-button>
    </div>
        <hr class="my-2">
        <div class="card">
<div class="table-responsive text-nowrap">

    <table id="myTable" class="table">
      <thead class="table-light">

        <tr class="bg-gray-200 text-left">
            <th>SN</th>
            <th>Room</th>
            <th>Staff</th>
            <th>Cleaning Date</th>
            <th>Shift</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($schedules as $schedule)
            <tr wire:key='{{$schedule->id}}'>
                <td>{{ $loop->index + 1 }}</td>
                <td> {{ DB::table('resv_rooms')->where('id', $schedule->room_id)->value('name') ?? 'N/A' }}  </td>
                <td> {{ DB::table('users')->where('id', $schedule->user_id)->value('name') ?? 'N/A' }}  </td>
                <!--<td>{{ $schedule->user->name ?? 'N/A' }}</td>-->
                <td>{{ Carbon::parse( $schedule->cleaning_date)->format('l jS \ F Y'); }}</td>
                <td>{{ $schedule->shift }}</td>
                <td>{{ $schedule->status }}</td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addAsset" wire:click="edit({{ $schedule->id }})">
                                <i class="ti ti-pencil me-1"></i> Edit
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)"
                             wire:confirm="Are you sure you want to proceed and delete this Cleaning Schedule?"
                            wire:click="delete({{ $schedule->id }})">
                                <i class="ti ti-trash me-1"></i> Delete
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
<!--/ Assets items -->

</div>

<form>
    @csrf
    <!-- Add New Fleet Item -->
    <div  wire:ignore.self  class="modal fade" data-bs-focus="false" id="addAsset" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
    <div class="modal-content">
      <div class="modal-body">
        <button wire:click='exit' type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        <div class="text-center mb-6">

          <h4 class="mb-2"><x-home-page-label>{{$modal_title}}</x-home-page-label></h4>
        </div>


          <div class="col-12">

                <label for="status" class="form-label">Room </label>
                <select wire:model="room_id" class="form-select form-select-lg" data-allow-clear="true">
                    <option value="">--Select Room--</option>
                    @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                </select>
                <br>

              <label for="" class="form-label">staff</label>
              <select wire:model="user_id" class="form-select form-select-lg" data-allow-clear="true">
                  <option value="">--Select Room Cleaner-</option>
                  @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
                </select>
                <br>



                <label for="status" class="form-label">Shift</label>
                <select wire:model="shift" class="form-select form-select-lg"  data-allow-clear="true">
                    <option value="">--Select Status--</option>
                    <option value="Morning">Morning</option>
                    <option value="Afternoon">Afternoon</option>
                    <option value="Evening">Evening</option>

                </select><br>

                <label class="form-label w-100" for="modaladdFleet">Cleaning Date</label>
                <div class="input-group input-group-merge">
                    <input wire:model="cleaning_date"   class="form-control form-control-lg" placeholder="Select arrival Date" type="text" id="flatpickr-date" required>
                    <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
                </div><br>


                <label for="status" class="form-label">Status</label>
                <select wire:model="status" class="form-select form-select-lg"
                    data-allow-clear="true">
                    <option value="">--Select Status--</option>
                    <option value="Scheduled">Scheduled</option>
                    <option value="Completed">Completed</option>
                    <option value="Skipped">Skipped</option>

                </select><br>

                <div class="col-12 text-center">
                    <!-- if flag is TRUE, display update action  button -->
                    <button wire:click='save' type="button" class="btn btn-primary">{{$modal_flag ? 'Update' : 'Save'}}</button>
                    <button wire:click='exit' type="button" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    <x-app-loader/>
                  </div>
                </form>
              </div>
            </div>
            </div>


            </div>
            <!--/ Asset Modal -->

            </div>

