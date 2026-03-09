<div>
<<<<<<< HEAD
    
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />

         <!-- Main JS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/dropzone/dropzone.css') }}" />

          <!-- flatpickr CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="../../assets/vendor/libs/spinkit/spinkit.css" />
    <!-- flatpickr date picker -->
 <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
 <!-- Page JS for forms-pickers.js-->
 <script src="{{ asset('assets/js/forms-pickers.js') }}"></script>
 <script src="{{ asset('assets/js/forms-pickers2.js') }}"></script>
 
    <br/> <br/> <br/> <br/> <br/>
<form onsubmit="return false">
    <div class="row">
        <!-- Arrival Date -->
        <div class="col-12 col-md-5 mb-3 d-flex flex-column justify-content-center">
            <label for="flatpickr-date" class="form-label fw-bold">Select Your Arrival Date</label>
            <input wire:model="checkin" class="form-control form-control-lg" placeholder="Select arrival date" type="text" id="flatpickr-date" required>
        </div>

        <!-- Departure Date -->
        <div class="col-12 col-md-5 mb-3 d-flex flex-column justify-content-center">
            <label for="flatpickr-date2" class="form-label fw-bold">Select Departure Date</label>
            <input wire:model="checkout" class="form-control form-control-lg" placeholder="Select departure date" type="text" id="flatpickr-date2" required>
        </div>

        <!-- Search Button -->
        <div class="col-12 col-md-2 d-flex align-items-center justify-content-center">
            <button wire:click="search" type="button" class="btn btn-primary w-100 py-3 fs-5 shadow-none rounded-0">
                Search
            </button>
        </div>
    </div>

    <x-app-loader>Searching...</x-app-loader>
</form>




=======
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

>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
</div>
