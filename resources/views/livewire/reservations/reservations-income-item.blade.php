<div>
    <x-input-error-messages/>

    <div class="container-xxl flex-grow-1 container-p-y">
            <!--/ page-label component -->
        <div>
            <x-home-page-label>Create, Update and Delete Income Items Here </x-home-page-label>
        </div>
         <!--/ action button component -->
    <div>
        <x-modal-home-create-button  data-bs-target="#createitem">Create item </x-modal-home-create-button>
    </div>
        <hr class="my-2">
        <div class="card">
<div class="table-responsive text-nowrap">

    <table id="myTable" class="table">
      <thead class="table-light">

                        <tr>
                            <th>SN</th>
                            <th>item</th>
                            
                            <th>Actions</th>
                        </tr>
                    </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($items as $item )
                            <tr wire:key='{{$item->id}}'>
                                <td>{{$loop->index + 1}}</td>
                                <td>
                                    {{$item->item}}
                                </td>
                              

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                        <div class="dropdown-menu">
                                            <a wire:click="edit({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#createitem" class="dropdown-item" href="javascript:void(0);"><i
                                                class="ti ti-pencil me-1"></i> Edit</a>
                                            <a wire:click='destroy({{ $item->id }})'
                                                wire:confirm="Are you sure you want to proceed and delete this item?"
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
            <!--/ item items -->

    </div>

  
    <!-- Add New item Modal -->
<div wire:ignore.self class="modal fade" id="createitem" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-simple modal-add-new-cc">
        <div class="modal-content">
            <div class="modal-body">
                <button wire:click='exit' type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="text-center mb-6">
                    <h4 class="mb-2"><x-home-page-label>{{ $modal_title }}</x-home-page-label></h4>
                </div>

                <form onsubmit="return false">
                    @csrf
                    <div class="col-12">

                        <label class="form-label w-100">Enter Item Name</label>
                        <input wire:model='item' class="form-control form-control-lg" type="text" />

                        <br>
                        <div class="col-12 text-center">
                            <button wire:click='save' type="button" class="btn btn-primary">
                                {{ $modal_flag ? 'Update' : 'Save' }}
                            </button>
                            <button wire:click='exit' type="button" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal">
                                Cancel
                            </button>
                             <x-app-loader></x-app-loader>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    </div>
