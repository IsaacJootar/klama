<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
   <div class="app-brand demo">
       <a href="/general/director-dashboard" class="app-brand-link">
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
       
       <li class="menu-item">
           <a href="/reservations/reservations-dashboard" class="menu-link">
               <i class="menu-icon tf-icons fa-solid fa-building"></i>
               <div data-i18n="RESERVATIONS">RESERVATIONS</div>
           </a>
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

      <li class="menu-item">
        <a href="/sales/sales-dashboard" class="menu-link"> {{-- Link to Sales & Marketing main dashboard --}}
          <i class="menu-icon tf-icons ti ti-chart-line"></i>
          <div data-i18n="SALES & MARKETING">SALES & MARKETING</div>
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