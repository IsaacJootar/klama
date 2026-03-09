<div>


    <div class="container-xxl flex-grow-1 container-p-y">
            <!--/ page-label component -->
        <div>
            <x-home-page-label>Create, update and delete hotel Rooms Here </x-home-page-label>
        </div>
         <!--/ action button component -->
    <div>
        <x-modal-home-create-button  data-bs-target="#createRoom">Create Rooms</x-modal-home-create-button>
    </div>
        <hr class="my-2">
        <div class="card">
<div class="table-responsive text-nowrap">

  <table id="myTable" class="table">
      <thead class="table-light">

                        <tr>
                            <th>SN</th>
                            <th>Room</th>
                            <th>Users</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($rooms as $room )


                            <tr wire:key='{{$room->id}}'>

                                <td>{{$loop->index + 1}}</td>
                                <td>
                                    {{$room->name}}
                                </td>
                                <td><span class="badge bg-label-primary me-1">Active</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                        <div class="dropdown-menu">
                                            <a data-bs-toggle="modal" data-bs-target="#createRoom" class="dropdown-item" href="javascript:void(0);" @click="$dispatch('modal-flag', { id: {{ $room->id }} })"><i
                                                class="ti ti-pencil me-1"></i> Edit</a>
                                            <a wire:click='destroyRoom({{ $room->id }})'
                                                wire:confirm="Are you sure you want to proceed and delete"
                                                class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ti ti-trash me-1"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Rooms Rows -->

    </div>


    <livewire:reservations.create-rooms>
</div>
