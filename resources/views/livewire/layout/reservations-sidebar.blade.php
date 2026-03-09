<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


    <div class="app-brand demo ">
<<<<<<< HEAD
   <a href="/reservations/reservations-dashboard" class="app-brand-link">
       
       <span class="app-brand-text demo menu-text fw-bold">Vine Suites</span>
=======
      <a  class="app-brand-link">
        <span class="app-brand-logo demo">
          <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
              fill="#7367F0" />
            <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
              d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
            <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
              d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
              fill="#7367F0" />
          </svg>
        </span>
        <span class="app-brand-text demo menu-text fw-bold">Vine Suites</span>
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
        <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>



    <ul class="menu-inner py-1">
      <!-- Dashboard Menus -->
      <li class="menu-item active open">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-smart-home"></i>
          <div data-i18n="RESERVATIONS">RESERVATIONS</div>
        </a>
        <ul class="menu-sub">

<<<<<<< HEAD
         @php
    $user = auth()->user()->load('userRoles');
    $userRole = $user->userRoles->aka;
@endphp

@if($userRole === 'GM' || $userRole === 'DIR')
    <x-active-menu-items :active="request()->is('reservations/home-create-rooms')"></x-active-menu-items>
    <a href="/reservations/home-create-rooms" class="menu-link">
        Rooms
    </a>
    </li>
    <x-active-menu-items :active="request()->is('reservations/home-create-room-category')"></x-active-menu-items>
    <a href="/reservations/home-create-room-category" class="menu-link">
        Room Category
    </a>
    </li>
    <x-active-menu-items :active="request()->is('reservations/home-create-room-allocation')"></x-active-menu-items>
    <a href="/reservations/home-create-room-allocation" class="menu-link">
        Rooms Allocations
    </a>
    </li>
@endif

=======
          <x-active-menu-items :active="request()->is('reservations/home-create-rooms')"></x-active-menu-items>
            <a href="/reservations/home-create-rooms"  class="menu-link" >
          Rooms
            </a>
          </li>
          <x-active-menu-items :active="request()->is('reservations/home-create-room-category')"></x-active-menu-items>
            <a href="/reservations/home-create-room-category"  class="menu-link">
            Room Category
            </a>
          </li>
          <x-active-menu-items :active="request()->is('reservations/home-create-room-allocation')"></x-active-menu-items>
            <a  href="/reservations/home-create-room-allocation"  class="menu-link" >
          Rooms Allocations
            </a>
          </li>
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
          <x-active-menu-items :active="request()->is('reservations/available-rooms')"></x-active-menu-items>
          <a href="/reservations/available-rooms" class="menu-link" >
          Available Rooms
            </a>
          </li>
          <x-active-menu-items :active="request()->is('reservations/reservations')"></x-active-menu-items>
            <a href="/reservations/reservations" class="menu-link" >
          Book a Room
            </a>
          </li>



          <x-active-menu-items :active="request()->is('reservations/reserved-rooms')"></x-active-menu-items>
          <a href="/reservations/reserved-rooms" class="menu-link" >
        Reserved Rooms
          </a>
        </li>
        <x-active-menu-items :active="request()->is('reservations/due-rooms')"></x-active-menu-items>
        <a href="/reservations/due-rooms" class="menu-link" >
      Due Rooms
        </a>
      </li>
      <x-active-menu-items :active="request()->is('reservations/checkedout-room')"></x-active-menu-items>
      <a href="/reservations/checkedout-rooms" class="menu-link" >
  Checked Out  Rooms
      </a>
    </li>
<<<<<<< HEAD
      
   
=======
      <x-active-menu-items :active="request()->is('reservations/room-swap')"></x-active-menu-items>
      <a href="/reservations/room-swap" class="menu-link">
    Swap Room(s)
      </a>
    </li>


    <x-active-menu-items :active="request()->is('')"></x-active-menu-items>
    <a href="#" class="menu-link">
  Cancel Reservation
    </a>
  </li>

  <x-active-menu-items :active="request()->is('')"></x-active-menu-items>
  <a href="#" class="menu-link">
Extend Reservation
  </a>
</li>
    <x-active-menu-items :active="request()->is('')"></x-active-menu-items>
    <a href="#" class="menu-link">
  Abandoned Reservations
    </a>
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
  </li>
      <x-active-menu-items :active="request()->is('reservations/reservation-feeds')"></x-active-menu-items>
      <a href="/reservations/reservation-feeds" class="menu-link" >
    Reservation Feeds
      </a>
    </li>
        </ul>
      </li>
<<<<<<< HEAD


     <li class="menu-item">
           <a href="javascript:void(0);" class="menu-link menu-toggle">
             <i class='menu-icon ti ti-receipt'></i>
             <div data-i18n="EXPENSES">EXPENSES</div>
           </a>
           <ul class="menu-sub">
               <x-active-menu-items :active="request()->is('reservations/reservations-expense-category')"></x-active-menu-items>
               <a  href="/reservations/reservations-expense-category"  class="menu-link"  >
                 <div data-i18n="Expense Category">Expense Category</div>
               </a>
             </li>
             <x-active-menu-items :active="request()->is('reservations/reservations-expense-item')"></x-active-menu-items>
             <a  href="/reservations/reservations-expense-item"  class="menu-link"  >
                 <div data-i18n="Expense Items">Expense Items</div>
               </a>
             </li>
             <x-active-menu-items :active="request()->is('reservations/reservations-make-expense')"></x-active-menu-items>
             <a  href="/reservations/reservations-make-expense"  class="menu-link"  >
                 <div data-i18n="Make Expense">Make Expense</div>
               </a>
             </li>
               </ul>
             </li>
<li class="menu-item">
           <a href="javascript:void(0);" class="menu-link menu-toggle">
             <i class='menu-icon ti ti-receipt'></i>
             <div data-i18n="INCOME">INCOME</div>
           </a>
           <ul class="menu-sub">
               <x-active-menu-items :active="request()->is('reservations/reservations-income-category')"></x-active-menu-items>
               <a  href="/reservations/reservations-income-category"  class="menu-link"  >
                 <div data-i18n="Income Category">Income Category</div>
               </a>
             </li>
             <x-active-menu-items :active="request()->is('reservations/reservations-income-item')"></x-active-menu-items>
             <a  href="/reservations/reservations-income-item"  class="menu-link"  >
                 <div data-i18n="Income Items">Income Items</div>
               </a>
             </li>
             <x-active-menu-items :active="request()->is('reservations/reservations-make-expense')"></x-active-menu-items>
             <a  href="/reservations/reservations-record-income"  class="menu-link"  >
                 <div data-i18n="Record & View Income">Record & View Income</div>
               </a>
             </li>
               </ul>
             </li>


=======


      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class='menu-icon tf-icons ti ti-calendar'></i>
          <div data-i18n="EVENTS">Manage Events </div>
        </a>
        <ul class="menu-sub">
            <x-active-menu-items :active="request()->is('')"></x-active-menu-items>
    <a href="#" class="menu-link">
              <div data-i18n="Event Categories">Event Categories </div>
            </a>
          </li>
         <x-active-menu-items :active="request()->is('')"></x-active-menu-items>
    <a href="#" class="menu-link">
              <div data-i18n="Event Items">Event Items</div>
            </a>
          </li>

          <x-active-menu-items :active="request()->is('')"></x-active-menu-items>
          <a href="#" class="menu-link">
                    <div data-i18n="Lease">Lease</div>
                  </a>
                </li>
            </ul>
          </li>
       <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class='menu-icon tf-icons ti ti-file-description'></i>
          <div data-i18n="REPORTS">REPORTS</div>
        </a>
        <ul class="menu-sub">
            <x-active-menu-items :active="request()->is('')"></x-active-menu-items>
    <a href="#" class="menu-link">
              <div data-i18n="Send Daily Reports">Send Daily Reports</div>
            </a>
          </li>
         <x-active-menu-items :active="request()->is('')"></x-active-menu-items>
    <a href="#" class="menu-link">
              <div data-i18n="Report History">Report History</div>
            </a>
          </li>
            </ul>
          </li>


          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class='menu-icon ti ti-messages'></i>
              <div data-i18n="MESSAGING">MESSAGING</div>
            </a>
            <ul class="menu-sub">
              <x-active-menu-items :active="request()->is('')"></x-active-menu-items>
    <a href="#" class="menu-link">
                  <div data-i18n="Send Daily Reports">Send Message</div>
                </a>
              </li>
             <x-active-menu-items :active="request()->is('')"></x-active-menu-items>
    <a href="#" class="menu-link">
                  <div data-i18n="Report History">Message History</div>
                </a>
              </li>
                </ul>
              </li>

>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa

        </ul>
      </li>




  </aside>
  <!-- / Menu -->
