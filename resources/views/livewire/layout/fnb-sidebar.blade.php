<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
 @php
    $user = auth()->user()->load('userRoles');
    $userRole = $user->userRoles->aka;
@endphp

   <div class="app-brand demo ">
       @if($userRole === 'GM' || $userRole === 'DIR') <a href="/fnb/dashboard" class="app-brand-link"> @endif
          
        
        <span class="app-brand-text demo menu-text fw-bold">Vine Suites</span> <!-- dont hard code client name-i will come back later -->
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
          <div data-i18n="kitchen & Restaurant">kitchen & Restaurant</div>
        </a>
        <ul class="menu-sub">
@if($userRole === 'GM' || $userRole === 'DIR')
            <x-active-menu-items :active="request()->is('fnb/dashboard')"></x-active-menu-items>
            <a href="/fnb/dashboard" class="menu-link" >
                Dashboard
            </a>
          </li>
@endif
          <x-active-menu-items :active="request()->is('fnb/menu')"></x-active-menu-items>
          <a href="/fnb/menu"  class="menu-link" >
              Manage Menus
          </a>
        </li>

          <x-active-menu-items :active="request()->is('fnb/order')"></x-active-menu-items>
            <a href="/fnb/order" class="menu-link" >
               Make Orders
            </a>
          </li>
         
          
         

        </ul>
        </li>

@if($userRole === 'GM' || $userRole === 'DIR')
 <li class="menu-item">
           <a href="javascript:void(0);" class="menu-link menu-toggle">
             <i class='menu-icon ti ti-receipt'></i>
             <div data-i18n="STORE">STORE</div>
           </a>
           <ul class="menu-sub">
               <x-active-menu-items :active="request()->is('fnb/kitchen-store-category')"></x-active-menu-items>
               <a  href="/fnb/kitchen-store-category"  class="menu-link"  >
                 <div data-i18n="Store Category">Store Category</div>
               </a>
             </li>
             <x-active-menu-items :active="request()->is('fnb/kitchen-store-item')"></x-active-menu-items>
             <a  href="/fnb/kitchen-store-item"  class="menu-link"  >
                 <div data-i18n="Store Items">Store Items</div>
               </a>
             </li>
             <x-active-menu-items :active="request()->is('fnb/kitchen-manage-store')"></x-active-menu-items>
             <a  href="/fnb/kitchen-manage-store"  class="menu-link"  >
                 <div data-i18n="Manage Store">Manage Store</div>
               </a>
             </li>
               </ul>
             </li>

          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class='menu-icon ti ti-messages'></i>
              <div data-i18n="INVENTORY">INVENTORY</div>
            </a>
            <ul class="menu-sub">

                <x-active-menu-items :active="request()->is('fnb/finventory-cat')"></x-active-menu-items>
                <a href="/fnb/finventory-cat" class="menu-link">
                    Inventory Categories
                </a>
                </li>
                <x-active-menu-items :active="request()->is('/fnb/finventories')"></x-active-menu-items>
                <a href="/fnb/finventories" class="menu-link">
                Inventory
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
               <x-active-menu-items :active="request()->is('fnb/fnb-expense-category')"></x-active-menu-items>
               <a  href="/fnb/fnb-expense-category"  class="menu-link"  >
                 <div data-i18n="Expense Category">Expense Category</div>
               </a>
             </li>
             <x-active-menu-items :active="request()->is('fnb/fnb-expense-item')"></x-active-menu-items>
             <a  href="/fnb/fnb-expense-item"  class="menu-link"  >
                 <div data-i18n="Expense Items">Expense Items</div>
               </a>
             </li>
             <x-active-menu-items :active="request()->is('fnb/fnb-make-expense')"></x-active-menu-items>
             <a  href="/fnb/fnb-make-expense"  class="menu-link"  >
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
               <x-active-menu-items :active="request()->is('fnb/fnb-income-category')"></x-active-menu-items>
               <a  href="/fnb/fnb-income-category"  class="menu-link"  >
                 <div data-i18n="Income Category">Income Category</div>
               </a>
             </li>
             <x-active-menu-items :active="request()->is('fnb/fnb-income-item')"></x-active-menu-items>
             <a  href="/fnb/fnb-income-item"  class="menu-link"  >
                 <div data-i18n="Income Items">Income Items</div>
               </a>
             </li>
             <x-active-menu-items :active="request()->is('fnb/fnb-make-expense')"></x-active-menu-items>
             <a  href="/fnb/fnb-record-income"  class="menu-link"  >
                 <div data-i18n="Record an Income">Record & View Income</div>
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
              <x-active-menu-items :active="request()->is('fnb-reports')"></x-active-menu-items>
              <a  href="fnb-reports"  class="menu-link" >
                <div data-i18n="Send Daily Reports">Send Daily Reports</div>
              </a>
            </li>
              <x-active-menu-items :active="request()->is('fnb-report-history')"></x-active-menu-items>
              <a  href="fnb-report-history"  class="menu-link" >
                <div data-i18n="Report History">Report History</div>
              </a>
            </li>
              </ul>
            </li>

        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class='menu-icon tf-icons ti ti-file-description'></i>
            <div data-i18n="MESSAGING">MESSAGING</div>
          </a>
          <ul class="menu-sub">
              <x-active-menu-items :active="request()->is('fnb/fnb-system-messages')"></x-active-menu-items>
              <a  href="/fnb/fnb-system-messages"  class="menu-link" >
                <div data-i18n="Send Daily Reports">Send Messages</div>
              </a>
            </li>
              </ul>
            </li>
            



    </ul>
  </li>
@endif



  </aside>
  <!-- / Menu -->
