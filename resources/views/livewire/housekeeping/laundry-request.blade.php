@php
    use Carbon\Carbon;
    use App\Http\Helpers\Helper;
    
@endphp

<x-input-error-messages/>

<div class="container-xxl flex-grow-1 container-p-y">
    <div>
    <x-home-page-label>Manage Laundry Requests</x-home-page-label>
    </div>
    
    <div>
        <x-modal-home-create-button data-bs-target="#addRequest">Add Laundry Request</x-modal-home-create-button>
    </div>
    <hr class="my-2">
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table id="myTable" class="table">
                <thead class="table-light">
                    <tr>
                        <th>SN</th>
                        <th>Guest Name</th>
                        <th>Room</th>
                        <th>Items</th>
                        <th>Total Cost</th>
                        <th>Service Type</th>
                        <th>Status</th>
                        <th>Requested At</th>
                        <th>Amount Received</th>
                        <th>Payment Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr wire:key="{{ $request->id }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $request->guest_name }}</td>
                            <td>{{ \App\Models\Room::where('id', $request->room_id)->value('name') ?? 'N/A' }}</td>
                            <td>{{ $request->items }}</td>
                            <td>{{ Helper::format_currency($request->total_cost, 2) }}</td>
                            <td>{{ $request->service_type }}</td>
                            <td><span class="badge bg-label-primary me-1">{{ $request->status }}</span></td>
                            <td>{{ Carbon::parse($request->requested_at)->format('l, jS \of F Y') }}</td>
                            <td>{{ Helper::format_currency($request->amount_received ?? 0, 2) }}</td>
                            <td><span class="badge bg-label-secondary me-1">{{ $request->payment_status ?? 'N/A' }}</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addRequest" wire:click="edit({{ $request->id }})">
                                            <i class="ti ti-pencil me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deliverRequest" wire:click="markDelivered({{ $request->id }})">
                                            <i class="ti ti-check me-1"></i> Mark as Delivered
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)" wire:confirm="Are you sure you want to delete this laundry request?" wire:click="delete({{ $request->id }})">
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
</div>

<!-- Add/Edit Laundry Request Modal -->
<div wire:ignore.self class="modal fade" data-bs-focus="false" id="addRequest" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-simple">
        <div class="modal-content">
            <div class="modal-body">
                <button wire:click="exit" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="mb-2"><x-home-page-label>{{ $modal_title }}</x-home-page-label></h4>
                </div>
                <form>
                    @csrf
                    <div class="col-12">
                        <label class="form-label w-100" for="guestName">Guest Name</label>
                        <input wire:model.debounce="guest_name" class="form-control form-control-lg" type="text" id="guestName" placeholder="Enter guest name" />
                        @error('guest_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div><br>
                    <div class="col-12">
                        <label class="form-label w-100" for="roomId">Room</label>
                        <select wire:model.debounce="room_id" class="form-select form-select-lg" id="roomId">
                            <option value="">--Select Room--</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                        @error('room_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div><br>
                    <div class="col-12">
                        <label class="form-label w-100" for="items">Items</label>
                        <textarea wire:model.debounce="items" class="form-control form-control-lg" id="items" placeholder="e.g., 2 white shirts, 1 black trousers"></textarea>
                        @error('items') <span class="text-danger">{{ $message }}</span> @enderror
                    </div><br>
                    <div class="col-12">
                        <label class="form-label w-100" for="totalCost">Total Cost</label>
                        <div class="input-group input-group-merge">
                            <input wire:model.debounce="total_cost" class="form-control form-control-lg" type="number" id="totalCost" placeholder="0.00" step="0.01" />
                            <span class="input-group-text">NGN</span>
                        </div>
                        @error('total_cost') <span class="text-danger">{{ $message }}</span> @enderror
                    </div><br>
                    <div class="col-12">
                        <label class="form-label w-100" for="serviceType">Service Type</label>
                        <select wire:model.debounce="service_type" class="form-select form-select-lg" id="serviceType">
                            <option value="Wash">Wash</option>
                            <option value="Dry Clean">Dry Clean</option>
                            <option value="Ironing">Ironing</option>
                            <option value="Wash and Iron">Wash and Iron</option>
                            <option value="Full Service">Full Service</option>
                        </select>
                        @error('service_type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div><br>
                    <div class="col-12">
                        <label class="form-label w-100" for="status">Status</label>
                        <select wire:model.debounce="status" class="form-select form-select-lg" id="status">
                            <option value="Received">Received</option>
                            <option value="Delivered">Delivered</option>
                        </select>
                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                    </div><br>
                    @if($status === 'Delivered')
                        <div class="col-12">
                            <label class="form-label w-100" for="amountReceived">Amount Received</label>
                            <div class="input-group input-group-merge">
                                <input wire:model.debounce="amount_received" class="form-control form-control-lg" type="number" id="amountReceived" placeholder="Enter amount received" step="0.01" value="{{ $amount_received ?? ($total_cost ?? 0) }}" />
                                <span class="input-group-text">NGN</span>
                            </div>
                            @error('amount_received') <span class="text-danger">{{ $message }}</span> @enderror
                        </div><br>
                    @endif
                    <div class="col-12">
                        <label class="form-label w-100" for="notes">Notes</label>
                        <textarea wire:model.debounce="notes" class="form-control form-control-lg" id="notes" placeholder="Additional instructions or notes"></textarea>
                        @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
                    </div><br>
                    <div class="col-12 text-center">
                        <button wire:click="save" type="button" class="btn btn-primary">{{ $modal_flag ? 'Update' : 'Save' }}</button>
                        <button wire:click="exit" type="button" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal">Cancel</button>
                        <x-app-loader/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Mark as Delivered Modal -->
<div wire:ignore.self class="modal fade" data-bs-focus="false" id="deliverRequest" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-simple">
        <div class="modal-content">
            <div class="modal-body">
                <button wire:click="exit" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="mb-2"><x-home-page-label>{{ $deliver_modal_title }}</x-home-page-label></h4>
                </div>
                <form>
                    @csrf
                    <div class="col-12">
                        <label class="form-label w-100" for="guestName">Guest Name</label>
                        <input wire:model="guest_name" class="form-control form-control-lg" type="text" id="guestName" readonly />
                    </div><br>
                    <div class="col-12">
                        <label class="form-label w-100" for="roomId">Room</label>
                        <select wire:model="room_id" class="form-select form-select-lg" id="roomId" disabled>
                            <option value="">--Select Room--</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div><br>
                    <div class="col-12">
                        <label class="form-label w-100" for="items">Items</label>
                        <textarea wire:model="items" class="form-control form-control-lg" id="items" readonly></textarea>
                    </div><br>
                    <div class="col-12">
                        <label class="form-label w-100" for="totalCost">Total Cost</label>
                        <div class="input-group input-group-merge">
                            <input wire:model="total_cost" class="form-control form-control-lg" type="number" id="totalCost" readonly />
                            <span class="input-group-text">NGN</span>
                        </div>
                    </div><br>
                    <div class="col-12">
                        <label class="form-label w-100" for="serviceType">Service Type</label>
                        <select wire:model="service_type" class="form-select form-select-lg" id="serviceType" disabled>
                            <option value="Wash">Wash</option>
                            <option value="Dry Clean">Dry Clean</option>
                            <option value="Ironing">Ironing</option>
                            <option value="Wash and Iron">Wash and Iron</option>
                            <option value="Full Service">Full Service</option>
                        </select>
                    </div><br>
                    <div class="col-12">
                        <label class="form-label w-100" for="amountReceived">Amount Received</label>
                        <div class="input-group input-group-merge">
                            <input wire:model.debounce="amount_received" class="form-control form-control-lg" type="number" id="amountReceived" placeholder="Enter amount received" step="0.01" value="{{ $amount_received ?? ($total_cost ?? 0) }}" />
                            <span class="input-group-text">NGN</span>
                        </div>
                        @error('amount_received') <span class="text-danger">{{ $message }}</span> @enderror
                    </div><br>
                    <div class="col-12">
                        <label class="form-label w-100" for="notes">Notes</label>
                        <textarea wire:model.debounce="notes" class="form-control form-control-lg" id="notes" placeholder="e.g., Delivered in good condition"></textarea>
                        @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
                    </div><br>
                    <div class="col-12 text-center">
                        <button wire:click="saveDelivered" type="button" class="btn btn-primary" wire:confirm="Are you sure you want to mark this laundry request as Delivered?">Mark as Delivered</button>
                        <button wire:click="exit" type="button" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal">Cancel</button>
                        <x-app-loader/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>