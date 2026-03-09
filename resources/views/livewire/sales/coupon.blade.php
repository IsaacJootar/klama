<?php
use App\Http\Helpers\Helper;
use Illuminate\Support\Str;
use Carbon\Carbon;
?>

<div>
    <x-input-error-messages/>

    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Label -->
        <div>
            <x-home-page-label>Manage Sales Coupons Here</x-home-page-label>
        </div>

        <!-- Action Button -->
        <div>
            <x-modal-home-create-button data-bs-target="#addCoupon">Create Coupon</x-modal-home-create-button>
        </div>
        <hr class="my-2">

        <!-- Coupons Table -->
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table id="myTable" class="table">
                    <thead class="table-light">
                        <tr class="bg-gray-200 text-left">
                            <th>SN</th>
                            <th>Coupon Code</th>
                            <th>Discount Value</th>
                            <th>Validity</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($coupons as $coupon)
                        <tr wire:key="{{ $coupon->id }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ Helper::format_currency($coupon->discount_value) }}</td>
                            <td>{{ $coupon->start_date->format('Y-m-d') }} to {{ $coupon->end_date->format('Y-m-d') }}</td>
                            <td>
                                @if ($coupon->usage_count >= 1)
                                    <span class="badge bg-label-danger">Used</span>
                                @elseif (Carbon::parse($coupon->end_date)->isPast())
                                    <span class="badge bg-label-warning">Expired</span>
                                @else
                                    <span class="badge bg-label-success">Active</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addCoupon" wire:click="edit({{ $coupon->id }})">
                                            <i class="ti ti-pencil me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)"
                                           wire:confirm="Are you sure you want to delete this coupon?"
                                           wire:click="delete({{ $coupon->id }})">
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

    <!-- Modal for Create/Edit Coupon -->
    <form>
        @csrf
        <div wire:ignore.self class="modal fade" data-bs-focus="false" id="addCoupon" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-simple modal-add-new-cc">
                <div class="modal-content">
                    <div class="modal-body">
                        <button wire:click="exit" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        <div class="text-center mb-6">
                            <h4 class="mb-2"><x-home-page-label>{{ $modal_title }}</x-home-page-label></h4>
                        </div>

                        <div class="col-12">
                            @if ($modal_flag)
                                <!-- Coupon Code (Edit Only) -->
                                <label class="form-label w-100" for="couponCode">Coupon Code</label>
                                <div class="input-group input-group-merge">
                                    <input wire:model="couponCode" class="form-control form-control-lg" type="text" id="couponCode" placeholder="e.g., A1B2C3"/>
                                    <span class="input-group-text cursor-pointer p-1">
                                        <i class="ti ti-ticket"></i>
                                    </span>
                                </div>
                                @error('couponCode') <span class="text-danger">{{ $message }}</span> @enderror
                                <br>
                            @else
                                <!-- Number of Coupons (Create Only) -->
                                <label class="form-label w-100" for="numCoupons">Number of Coupons to Create</label>
                                <div class="input-group input-group-merge">
                                    <input wire:model="numCoupons" class="form-control form-control-lg" type="number" id="numCoupons" placeholder="e.g., 10" min="1" max="100"/>
                                    <span class="input-group-text cursor-pointer p-1">
                                        <i class="ti ti-ticket"></i>
                                    </span>
                                </div>
                                @error('numCoupons') <span class="text-danger">{{ $message }}</span> @enderror
                                <br>
                            @endif

                            <!-- Discount Value -->
                            <label class="form-label w-100" for="discountValue">Discount Value</label>
                            <div class="input-group input-group-merge">
                                <input wire:model="discountValue" class="form-control form-control-lg" type="number" id="discountValue" placeholder="e.g., 25000" step="0.01"/>
                                <span class="input-group-text cursor-pointer p-1">
                                    <i class="ti ti-currency-dollar"></i>
                                </span>
                            </div>
                            @error('discountValue') <span class="text-danger">{{ $message }}</span> @enderror
                            <br>

                            <!-- Start Date -->
                            <label class="form-label w-100" for="startDate">Start Date</label>
                            <div class="input-group input-group-merge">
                                <input wire:model="startDate" class="form-control form-control-lg" type="date" id="startDate" placeholder="Select start date"/>
                                <span class="input-group-text cursor-pointer p-1">
                                    <i class="ti ti-calendar"></i>
                                </span>
                            </div>
                            @error('startDate') <span class="text-danger">{{ $message }}</span> @enderror
                            <br>

                            <!-- End Date -->
                            <label class="form-label w-100" for="endDate">End Date</label>
                            <div class="input-group input-group-merge">
                                <input wire:model="endDate" class="form-control form-control-lg" type="date" id="endDate" placeholder="Select end date"/>
                                <span class="input-group-text cursor-pointer p-1">
                                    <i class="ti ti-calendar"></i>
                                </span>
                            </div>
                            @error('endDate') <span class="text-danger">{{ $message }}</span> @enderror
                            <br>
                        </div>

                        <div class="col-12 text-center mt-4">
                            <button wire:click="save" type="button" class="btn btn-primary">
                                {{ $modal_flag ? 'Update' : 'Generate' }}
                            </button>
                            <button wire:click="exit" type="button" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">
                                Cancel
                            </button>
                            <x-app-loader/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>