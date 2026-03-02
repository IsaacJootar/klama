<div>
    <br/> <br/> <br/> <br/> <br/>
        <form onSubmit="return false">
    <div class="row">
        <div class="col-5">
            <label for="flatpickr-date" class="form-label fw-bold">Select Arrival Date</label>
            <input wire:model="checkin" class="form-control form-control-lg" placeholder="Select arrival date" type="text" id="flatpickr-date" required>
        </div>
        <div class="col-5">
            <label for="flatpickr-date2" class="form-label fw-bold">Select Departure Date</label>
            <input wire:model="checkout" class="form-control form-control-lg" placeholder="Select departure date" type="text" id="flatpickr-date2" required>
        </div>
        <div class="col-2 d-flex align-items-end">
    <button wire:click='search' type="button" style="width:100px;height:45px;" class="btn btn-primary shadow-none rounded-0 rounded-end-bottom rounded-end-top">
        Search
    </button>
</div>

    </div>
  <x-app-loader>Searching...</x-app-loader>
</form>

</div>
