<div>
    <x-input-error-messages/>

    <div class="container-xxl flex-grow-1 container-p-y">
            <!--/ page-label component -->
        <div>
            <x-home-page-label>Create, update and delete Maintenace Assets Here </x-home-page-label>
        </div>
         <!--/ action button component -->
    <div>
        <x-modal-home-create-button  data-bs-target="#addAsset">Create Inventory </x-modal-home-create-button>
    </div>
        <hr class="my-2">
        <div class="card">
<div class="table-responsive text-nowrap">

    <table id="myTable" class="table">
      <thead class="table-light">

        <tr class="bg-gray-200 text-left">
            <th>SN</th>
            <th>Item Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Quantity</th>
     
            <th>Condition</th>
            <th>Actions</th>
        </tr>
                    </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($inventories as $inventory)
                            <tr wire:key='{{$inventory->id}}'>
                                <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $inventory->item_name }}</td>
                            <td>{{ DB::table('fnb_inventory_cats')->where('id', $inventory->category_id)->value('name') }}</td>
                            <td>{{ $inventory->price }}</td>
                            <td>{{ $inventory->quantity }}</td>
                    
                            <td>{{ $inventory->condition }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addAsset" wire:click="edit({{ $inventory->id }})">
                                                <i class="ti ti-pencil me-1"></i> Edit
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0)"
                                             wire:confirm="Are you sure you want to proceed and delete this Inventory?"
                                            wire:click="delete({{ $inventory->id }})">
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

                <label class="form-label w-100" for="modaladdFleet">Name </label>
                <div class="input-group input-group-merge">
                  <input wire:model='item_name' class="form-control form-control-lg" type="text" aria-describedby="modaladdFleet" placeholder="e.g. Kenwood  Blender" />
                  <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
                </div>
                    <br>
                <label for="status" class="form-label">Asset Category</label>
                <select wire:model="category_id" class="form-select form-select-lg" data-allow-clear="true">
                    <option value="">--Select Category-</option>
                    @foreach ($cats as $cat)

                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                  </select><br>

                  <label class="form-label w-100" for="modalAddValue"> Estimated Value</label>
                  <div class="input-group input-group-merge">
                    <input wire:model='price' class="form-control form-control-lg" type="text" aria-describedby="modalAllocate" />
                    <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
                  </div>
                    <br>
                    <label class="form-label w-100" for="modalAddValue"> Quantity</label>
                    <div class="input-group input-group-merge">
                      <input wire:model='quantity' class="form-control form-control-lg" type="text" aria-describedby="modalAllocate" />
                      <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
                    </div>
                      <br>

                     
                <label for="status" class="form-label">Item Condition</label>
                <select wire:model="condition" class="form-select form-select-lg"
                    data-allow-clear="true">
                    <option value="">--Select Condition--</option>

                    <option value="Good">Good</option>
                    <option value="Bad">Bad (Damaged)</option>
                   
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

