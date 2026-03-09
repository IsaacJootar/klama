<div>
    <x-input-error-messages/>
@php
    use Carbon\Carbon;
@endphp
    <div class="container-xxl flex-grow-1 container-p-y">
            <!--/ page-label component -->
        <div>
            <x-home-page-label>Create, update and delete Housekeeping Here </x-home-page-label>
        </div>
         <!--/ action button component -->
    <div>
        <x-modal-home-create-button  data-bs-target="#addAsset">Create Housekeeping Status </x-modal-home-create-button>
    </div>
        <hr class="my-2">
        <div class="card">
<div class="table-responsive text-nowrap">

    <table id="myTable" class="table">
      <thead class="table-light">

        <tr class="bg-gray-200 text-left">
            <th>SN</th>
            <th>Room</th>
            <th>Status</th>
            <th>Last Cleaned</th>
            <th>Next Cleaning Due</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Statuses as $status)
            <tr wire:key='{{$status->id}}'>
                <td>{{ $loop->index + 1 }}</td>
                <td> {{ DB::table('resv_rooms')->where('id', $status->room_id)->value('name') ?? 'N/A' }}  </td>
                <td>{{ $status->status  }}</td>
                <td>{{ Carbon::parse($status->last_cleaned_at)->format('l jS \ F Y') }}</td>
                <td>{{ Carbon::parse($status->next_cleaning_due)->format('l jS \ F Y')}}</td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addAsset" wire:click="edit({{ $status->id }})">
                                <i class="ti ti-pencil me-1"></i> Edit
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)"
                             wire:confirm="Are you sure you want to proceed and delete this Housekeeping Status?"
                            wire:click="delete({{ $status->id }})">
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

                <label for="status" class="form-label">Room status</label>
                <select wire:model="status" class="form-select form-select-lg"
                    data-allow-clear="true">
                    <option value="">--Select status--</option>
                    <option value="Clean">Clean</option>
                    <option value="Dirty">Dirty</option>
                    <option value="Under Maintenance">Under Maintenance</option>
                </select>
                <br>

                <label class="form-label w-100" for="modaladdFleet">last cleaned at</label>
                <div class="input-group input-group-merge">
                    <input wire:model="last_cleaned_at"   class="form-control form-control-lg" placeholder="Select arrival Date" type="date" id="flatpickr-date" required>
                </div>
                <br>

                <label class="form-label w-100" for="modaladdFleet">Next Cleaning Due</label>
                <div class="input-group input-group-merge">
                    <input wire:model="next_cleaning_due"   class="form-control form-control-lg" placeholder="Select arrival Date" type="date" id="flatpickr-date" required>
                </div>
                <br>

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

