<div>
    <x-input-error-messages/>

    <div class="container-xxl flex-grow-1 container-p-y">
            <!--/ page-label component -->
            <div>
                <x-home-page-label>Create, update, and delete Orders Here</x-home-page-label>
            </div>

            <div>
                <x-modal-home-create-button data-bs-target="#addOrder">Create Order Item</x-modal-home-create-button>
            </div>
        <hr class="my-2">
        <div class="card">
<div class="table-responsive text-nowrap">

    <table id="myTable" class="table">
      <thead class="table-light">

        <tr class="bg-gray-200 text-left">
            <th>SN</th>
            <th>Order ID</th>
            <th>Menu Item</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        @foreach ($order_items as $order_item)
        <tr wire:key='{{ $order_item->id }}'>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ DB::table('fnb_orders')->where('id', $order_item->order_id)->value('guest_name') ?? 'N/A' }} </td>
            <td>{{ DB::table('fnb_menus')->where('id', $order_item->menu_id)->value('name') ?? 'N/A' }} </td>
            <td>{{ $order_item->quantity }}</td>
            <td>${{ Helper::format_currency($order_item->subtotal) }}</td>
            <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addAsset" wire:click="edit({{ $order_item->id }})">
                            <i class="ti ti-pencil me-1"></i> Edit
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)"
                            wire:confirm="Are you sure you want to proceed and delete this Order Item?"
                        wire:click="delete({{ $order_item->id }})">
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
    <div  wire:ignore.self  class="modal fade" data-bs-focus="false" id="addOrder" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
        <div class="modal-content">
          <div class="modal-body">
            <button wire:click='exit' type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="text-center mb-6">

              <h4 class="mb-2"><x-home-page-label>{{$modal_title}}</x-home-page-label></h4>
            </div>


              <div class="col-12">

                <label class="form-label w-100 mt-2" for="menu_item_id">Order ID</label>
                <select wire:model="order_id" class="form-select form-select-lg">
                    <option value="">Select Order ID</option>
                    @foreach ($orders as $order)
                    <option value="{{ $order->id }}">{{ $order->guest_name }}</option>
                    @endforeach
                </select>
                <br>
                <label class="form-label w-100 mt-2" for="menu_item_id">Menu Item</label>
                <select wire:model="menu_id" class="form-select form-select-lg">
                    <option value="">Select Menu Item</option>
                    @foreach ($menus as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                    @endforeach
                </select>
                <br>
                <label class="form-label w-100 mt-2" for="quantity">Quantity</label>
                <input wire:model='quantity' class="form-control form-control-lg" type="number" placeholder="Quantity" />
                <br>
                <label class="form-label w-100 mt-2" for="price">Price</label>
                <input wire:model='subtotal' class="form-control form-control-lg" type="number" step="0.01" placeholder="Price" />
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

