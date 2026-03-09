v<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


   <div class="app-brand demo ">
      <a href="/logistics/activity-log" class="app-brand-link">
       
        <span class="app-brand-text demo menu-text fw-bold">Vine Suites</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
        <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>


    <ul class="menu-inner py-1">
      <!-- Logistics Menus- Default (Active Open)  -->
      <li class="menu-item active open">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-truck"></i>
          <div data-i18n="LOGISTICS">LOGISTICS</div>
        </a>
        <ul class="menu-sub">

          <x-active-menu-items :active="request()->is('logistics/activity-log')"></x-active-menu-items>
            <a  href="/logistics/activity-log"  class="menu-link"  >
          Activity Logs
            </a>
          </li>

          <x-active-menu-items :active="request()->is('logistics/fleet-items')"></x-active-menu-items>
          <a  href="/logistics/fleet-items"  class="menu-link"  >
         Manage Fleet
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
               <x-active-menu-items :active="request()->is('logistics/logistics-expense-category')"></x-active-menu-items>
               <a  href="/logistics/logistics-expense-category"  class="menu-link"  >
                 <div data-i18n="Expense Category">Expense Category</div>
               </a>
             </li>
             <x-active-menu-items :active="request()->is('logistics/logistics-expense-item')"></x-active-menu-items>
             <a  href="/logistics/logistics-expense-item"  class="menu-link"  >
                 <div data-i18n="Expense Items">Expense Items</div>
               </a>
             </li>
             <x-active-menu-items :active="request()->is('logistics/logistics-make-expense')"></x-active-menu-items>
             <a  href="/logistics/logistics-make-expense"  class="menu-link"  >
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
               <x-active-menu-items :active="request()->is('logistics/logistics-income-category')"></x-active-menu-items>
               <a  href="/logistics/logistics-income-category"  class="menu-link"  >
                 <div data-i18n="Income Category">Income Category</div>
               </a>
             </li>
             <x-active-menu-items :active="request()->is('logistics/logistics-income-item')"></x-active-menu-items>
             <a  href="/logistics/logistics-income-item"  class="menu-link"  >
                 <div data-i18n="Income Items">Income Items</div>
               </a>
             </li>
             <x-active-menu-items :active="request()->is('logistics/logistics-make-expense')"></x-active-menu-items>
             <a  href="/logistics/logistics-record-income"  class="menu-link"  >
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
            <x-active-menu-items :active="request()->is('logistics/reports')"></x-active-menu-items>
            <a  href="/logistics/reports"  class="menu-link"  >
              <div data-i18n="Send Daily Reports">Send Daily Reports</div>
            </a>
          </li>
          <x-active-menu-items :active="request()->is('logistics/report-history')"></x-active-menu-items>
          <a  href="/logistics/report-history"  class="menu-link"  >
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
                <x-active-menu-items :active="request()->is('logistics/system-messages')"></x-active-menu-items>
                <a  href="/logistics/system-messages"  class="menu-link"  >
                  <div data-i18n="Send Daily Reports">Send Message</div>
                </a>
              </li>
              <x-active-menu-items :active="request()->is('logistics/message-history')"></x-active-menu-items>
              <a  href="/logistics/message-history"  class="menu-link"  >
                  <div data-i18n="Report History">Message History</div>
                </a>
              </li>
                </ul>
              </li>


        </ul>
      </li>




  </aside>
  <!-- / Logistics Menu -->
