<<<<<<< HEAD
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
=======
<div>


    <hr class="my-2">
    <form>
        @csrf
        <!-- Filter Checkedout  Dates Modal -->
        <div wire:ignore.self class="modal fade" id="filterCheckedDate" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                <div class="modal-content">
                    <div class="modal-body">
                        <button wire:click='exit' type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <div class="text-center mb-6">

                            <h4 class="mb-2">
                                <x-home-page-label>Filter Checked out Dates</x-home-page-label>
                            </h4>
                        </div>
                        <div class="col-12">
                            <div class="mt-2 mb-4">
                                <label for="largeSelect" class="form-label">Select Search Dates</label>
                                <select wire:model="due_period" id="largeSelect" class="form-select form-select-lg">
                                    <option>-------</option>
                                    <option value="today"> Today </option>
                                    <option value="yesterday"> yesterday </option>
                                    <option value="three">3 days back </option>
                                    <option value="four">4 days back </option>
                                    <option value="week">  1 Week Back </option>
                                    <option value="month">1 Month Back </option>
                                    <option value="year"> A year Back </option>
                                </select>
                            </div>
                            <br>
                            <div class="col-12 text-center">


                                <button wire:click='due' type="button" class="btn btn-primary">Search</button>
                                <button wire:click='exit' type="button" class="btn btn-label-secondary btn-reset"
                                    data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                <x-app-loader />

                            </div>
    </form>
</div>
</div>
</div>


</div>
<!--/ filter checked Dates  Modal -->


</div>
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
