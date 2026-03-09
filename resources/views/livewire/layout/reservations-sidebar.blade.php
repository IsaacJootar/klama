<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


    <div class="app-brand demo ">
   <a href="/reservations/reservations-dashboard" class="app-brand-link">
       
       <span class="app-brand-text demo menu-text fw-bold">Vine Suites</span>
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
      
   
  </li>
      <x-active-menu-items :active="request()->is('reservations/reservation-feeds')"></x-active-menu-items>
      <a href="/reservations/reservation-feeds" class="menu-link" >
    Reservation Feeds
      </a>
    </li>
        </ul>
      </li>


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



        </ul>
      </li>




  </aside>
  <!-- / Menu -->
