<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
   <div class="app-brand demo ">
       <a href="/general/general-dashboard" class="app-brand-link">
          
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
               <i class='menu-icon tf-icons ti ti-users'></i>
               <div data-i18n="MANAGE USERS">MANAGE USERS</div>
           </a>
           <ul class="menu-sub">
               <x-active-menu-items :active="request()->is('general/createuser-account')"></x-active-menu-items>
               <a href="/general/createuser-account" class="menu-link">
                   <div data-i18n="Create Account">Create Account</div>
               </a>
               </li>
               <x-active-menu-items :active="request()->is('general/hotel_sections')"></x-active-menu-items>
               <a href="/general/hotel_sections" class="menu-link">
                   <div data-i18n="Hotel Section">Hotel Sections</div>
               </a>
               </li>
               <x-active-menu-items :active="request()->is('general/system_roles')"></x-active-menu-items>
               <a href="/general/system_roles" class="menu-link">
                   <div data-i18n="system Roles">System Roles</div>
               </a>
               </li>
           </ul>
       </li>

       <!-- Bank Details -->
       <li class="menu-item">
           <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class='menu-icon ti ti-wallet'></i>
               <div data-i18n="BANK DETAILS">BANK DETAILS</div>
           </a>
           <ul class="menu-sub">
               <x-active-menu-items :active="request()->is('general/bank-detail')"></x-active-menu-items>
               <a href="/general/bank-detail" class="menu-link">
                   <div data-i18n="Create Bank Details">Create Bank Details</div>
               </a>
               </li>
           </ul>
       </li>

       <!-- Expenses -->
       <li class="menu-item">
           <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class='menu-icon ti ti-receipt'></i>
               <div data-i18n="GENERAL EXPENSES">GENERAL EXPENSES</div>
           </a>
           <ul class="menu-sub">
               <x-active-menu-items :active="request()->is('general/general-expense-category')"></x-active-menu-items>
               <a href="/general/general-expense-category" class="menu-link">
                   <div data-i18n="Expense Category">Expense Category</div>
               </a>
               </li>
               <x-active-menu-items :active="request()->is('general/general-expense-item')"></x-active-menu-items>
               <a href="/general/general-expense-item" class="menu-link">
                   <div data-i18n="Expense Items">Expense Items</div>
               </a>
               </li>
               <x-active-menu-items :active="request()->is('general/general-make-expense')"></x-active-menu-items>
               <a href="/general/general-make-expense" class="menu-link">
                   <div data-i18n="Make Expense">Make Expense</div>
               </a>
               </li>
           </ul>
       </li>

       <!-- Income -->
       <li class="menu-item">
           <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class='menu-icon ti ti-receipt'></i>
               <div data-i18n="GENERAL INCOME">GENERAL INCOME</div>
           </a>
           <ul class="menu-sub">
               <x-active-menu-items :active="request()->is('general/general-income-category')"></x-active-menu-items>
               <a href="/general/general-income-category" class="menu-link">
                   <div data-i18n="Income Category">Income Category</div>
               </a>
               </li>
               <x-active-menu-items :active="request()->is('general/general-income-item')"></x-active-menu-items>
               <a href="/general/general-income-item" class="menu-link">
                   <div data-i18n="Income Items">Income Items</div>
               </a>
               </li>
               <x-active-menu-items :active="request()->is('general/general-record-income')"></x-active-menu-items>
               <a href="/general/general-record-income" class="menu-link">
                   <div data-i18n="Record & View Income">Record & View Income</div>
               </a>
               </li>
           </ul>
       </li>

       <!-- Reservations -->
       <li class="menu-item">
           <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class="menu-icon tf-icons fa-solid fa-building"></i>
               <div data-i18n="RESERVATIONS">RESERVATIONS</div>
           </a>
           <ul class="menu-sub">
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
               <x-active-menu-items :active="request()->is('reservations/available-rooms')"></x-active-menu-items>
               <a href="/reservations/available-rooms" class="menu-link">
                   Available Rooms
               </a>
               </li>
               <x-active-menu-items :active="request()->is('reservations/reservations')"></x-active-menu-items>
               <a href="/reservations/reservations" class="menu-link">
                   Book a Room
               </a>
               </li>
               <x-active-menu-items :active="request()->is('reservations/reserved-rooms')"></x-active-menu-items>
               <a href="/reservations/reserved-rooms" class="menu-link">
                   Reserved Rooms
               </a>
               </li>
               <x-active-menu-items :active="request()->is('reservations/due-rooms')"></x-active-menu-items>
               <a href="/reservations/due-rooms" class="menu-link">
                   Due Rooms
               </a>
               </li>
               <x-active-menu-items :active="request()->is('reservations/checkedout-rooms')"></x-active-menu-items>
               <a href="/reservations/checkedout-rooms" class="menu-link">
                   Checked Out Rooms
               </a>
               </li>
               <x-active-menu-items :active="request()->is('reservations/room-swap')"></x-active-menu-items>
               <a href="/reservations/room-swap" class="menu-link">
                   Swapped Room(s)
               </a>
               </li>
               <x-active-menu-items :active="request()->is('reservations/reservation-feeds')"></x-active-menu-items>
               <a href="/reservations/reservation-feeds" class="menu-link">
                   Reservation Feeds
               </a>
               </li>
           </ul>
       </li>
               
       </li>

       <!-- Maintenance -->
       <li class="menu-item">
        <a href="/maintenance/main-dashboard" class="menu-link">
               <i class='menu-icon ti ti-menu'></i>
               <div data-i18n="MAINTENANCE">MAINTENANCE</div>
           </a>
       </li>

       <!-- Module Jump Links -->
       <li class="menu-item">
           <a href="/logistics/activity-log" class="menu-link">
               <i class="menu-icon tf-icons ti ti-truck"></i>
               <div data-i18n="LOGISTICS">LOGISTICS</div>
           </a>
       </li>

       <li class="menu-item">
           <a href="/housekeeping/house-dashboard" class="menu-link">
               <i class='menu-icon ti ti-layout'></i>
               <div data-i18n="HOUSEKEEPING">HOUSEKEEPING</div>
           </a>
       </li>

      <li class="menu-item">
        <a href="/sales/sales-dashboard" class="menu-link"> {{-- Link to Sales & Marketing main dashboard --}}
          <i class="menu-icon tf-icons ti ti-chart-line"></i>
          <div data-i18n="SALES & MARKETING">SALES & MARKETING</div>
        </a>
      </li>
       <li class="menu-item">
           <a href="/maintenance/main-dashboard" class="menu-link">
               <i class='menu-icon ti ti-menu'></i>
               <div data-i18n="MAINTENANCE">MAINTENANCE</div>
           </a>
       </li>

       <li class="menu-item">
           <a href="/fnb/dashboard" class="menu-link">
               <i class='menu-icon fa-solid fa-kitchen-set'></i>
               <div data-i18n="KITCHEN & RESTAURANTS">KITCHEN & RESTAURANTS</div>
           </a>
       </li>

       <!-- Reports -->
       <li class="menu-item">
           <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class='menu-icon tf-icons ti ti-file-description'></i>
               <div data-i18n="REPORTS">REPORTS</div>
           </a>
           <ul class="menu-sub">
               <x-active-menu-items :active="request()->is('/general/generate-reports')"></x-active-menu-items>
               <a href="/general/generate-reports" class="menu-link">
                   <div data-i18n="Generate Reports">Generate Reports</div>
               </a>
               </li>
           </ul>
       </li>
   </ul>
</aside>
<!-- / Menu -->
