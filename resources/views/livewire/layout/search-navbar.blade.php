
<nav class="layout-navbar shadow-none py-0">
    <div class="container">
      <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-8">
        <!-- Menu logo wrapper: Start -->
        <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4 me-xl-8">
          <!-- Mobile menu toggle: Start-->
          <button class="navbar-toggler border-0 px-0 me-4" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="ti ti-menu-2 ti-lg align-middle text-heading fw-medium"></i>
          </button>
          <!-- Mobile menu toggle: End-->
          <a href="#" class="app-brand-link">
            <span class="app-brand-logo demo">
              <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0" />
                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"  d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"fill="#7367F0" />
              </svg>
            </span>

            <div class="input-group mb-3">

                <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">return to website</span>
              </div>
            </div>

          </a>
          <div class="row">
            <div class="col-5">
                <input wire:model='checkin'  class="form-control form-control-lg" name="checkin" placeholder="Select arrival Date" type="text" id="flatpickr-date" required>
            </div>
            <div class="col-5">
                <input wire:model='checkout'  class="form-control form-control-lg" name="checkout" placeholder="Select departure Date" type="text" id="flatpickr-date2" required>

            </div>
            <div class="col-2">
              <div class="input-group mb-3">

                <button wire:click='search'  style="width:100px;height:45px;" class="btn btn-primary shadow-none rounded-0 rounded-end-bottom rounded-end-top">
                    Search
                  </button>
              </div>
            </div>

          </div>

        </div>
        <!-- Menu wrapper: Start -->

        <div class="landing-menu-overlay d-lg-none"></div>
        <!-- Menu wrapper: End -->
      </div>
    </div>
  </nav>
