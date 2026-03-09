@php
    use App\Http\Helpers\Helper;
@endphp
<div>

    <div class="container-xxl flex-grow-1 container-p-y">
            <!--/ page-label component -->
        <div>
            <x-home-page-label>Create, update and remove Hotel Allocations Here </x-home-page-label>
        </div>
         <!--/ action button component -->
    <div>
        <x-modal-home-create-button data-bs-target="#roomAllocationModal">Allocate allocations</x-modal-home-create-button>
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
                            <th>Price</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($allocations as $allocation)


                            <tr wire:key='{{$allocation->id}}'>

                                <td>{{$loop->index + 1}}</td>
                                <td>{{Str::ucfirst(\App\Models\Room::where('id', $allocation->room_id)->value('name'))}}
                                </td>
                                <td>{{str::ucfirst(\App\Models\Roomcategory::where('id', $allocation->category_id)->value('category'))}}
                                </td>

                                <td>

                                    {{ Helper::format_currency($allocation->price) }}
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                    <div class="dropdown-menu">
                                        <a data-bs-toggle="modal" data-bs-target="#roomAllocationModal" class="dropdown-item" href="javascript:void(0);" @click="$dispatch('modal-flag', { id: {{ $allocation->id }} })"><i
                                            class="ti ti-pencil me-1"></i> Edit</a>
                                        <a wire:click='destroyAllocation({{ $allocation->id }})' class="dropdown-item" href="javascript:void(0);"><i
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
            <!--/ categories Rows -->

    </div>


    <livewire:reservations.create-room-allocation>
</div>
