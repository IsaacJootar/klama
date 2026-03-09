@php
    use App\Http\Helpers\Helper;
@endphp

<div>
    <form>
        @csrf
        <div wire:ignore.self class="modal fade" id="filterCheckedDate" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-simple modal-add-new-cc">
                <div class="modal-content">
                    <div class="modal-body">
                        <button wire:click="exit" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-6">
                            <h4 class="mb-2"><x-home-page-label>Filter Checked-Out Dates</x-home-page-label></h4>
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label for="duePeriod" class="form-label">Select Search Period</label>
                                <select wire:model.live="due_period" id="duePeriod" class="form-select form-select-lg">
                                    <option value="">Select Period</option>
                                    <option value="today">Today</option>
                                    <option value="yesterday">Yesterday</option>
                                    <option value="week">Last Week</option>
                                    <option value="month">Last Month</option>
                                    <option value="year">Last Year</option>
                                    <option value="all">All Time</option>
                                </select>
                                @error('due_period') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12 text-center">
                                <button wire:click="due" type="button" class="btn btn-primary">Search</button>
                                <button wire:click="exit" type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Cancel</button>
                                <x-app-loader />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
