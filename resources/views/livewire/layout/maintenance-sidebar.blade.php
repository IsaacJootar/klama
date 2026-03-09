<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


   <div class="app-brand demo ">
      <a href="/maintenance/main-dashboard" class="app-brand-link">
      
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
          <div data-i18n="MAINTENANCE">MAINTENANCE</div>
        </a>
        <ul class="menu-sub">

            <x-active-menu-items :active="request()->is('maintenance/main-dashboard')"></x-active-menu-items>
            <a href="/maintenance/main-dashboard"  class="menu-link" >
          Dashboard
            </a>
          </li>

          <x-active-menu-items :active="request()->is('maintenance/asset-cat')"></x-active-menu-items>
            <a href="/maintenance/asset-cat" class="menu-link" >
          Assets Category
            </a>
          </li>

          <x-active-menu-items :active="request()->is('maintenance/asset')"></x-active-menu-items>
          <a href="/maintenance/asset" class="menu-link" >
        Assets
          </a>
        </li>
          <x-active-menu-items :active="request()->is('maintenance/request-maintenance')"></x-active-menu-items>
            <a href="/maintenance/request-maintenance"  class="menu-link">
                Request Maintenance
            </a>
          </li>
          <x-active-menu-items :active="request()->is('maintenance/history')"></x-active-menu-items>
            <a  href="/maintenance/history"  class="menu-link">
                Maintenance History
            </a>
          </li>
          <x-active-menu-items :active="request()->is('maintenance/schedules')"></x-active-menu-items>
          <a href="/maintenance/schedules" class="menu-link">
            Maintenance Schedules
            </a>
          </li>
          <x-active-menu-items :active="request()->is('maintenance/technician')"></x-active-menu-items>
          <a href="/maintenance/technician" class="menu-link">
            Technician
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

                <x-active-menu-items :active="request()->is('maintenance/inventory-cat')"></x-active-menu-items>
                <a href="/maintenance/inventory-cat" class="menu-link">
                    Inventory Categories
                </a>
                </li>
                <x-active-menu-items :active="request()->is('maintenance/inventories')"></x-active-menu-items>
                <a href="/maintenance/inventories" class="menu-link">
                Inventory
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
              <x-active-menu-items :active="request()->is('maintenance-report')"></x-active-menu-items>
              <a  href="maintenance-report"  class="menu-link" >
                <div data-i18n="Send Daily Reports">Send Daily Reports</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="Reporting Channel">Reporting Channel</div>
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
                <li class="menu-item">
                  <a href="#" class="menu-link">
                    <div data-i18n="Send Message">Send Messages</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <div data-i18n="Messaging Channel">Messaging Channel</div>
                  </a>
                </li>

                  </ul>
                </li>


    </ul>
  </li>




  </aside>
  <!-- / Menu -->
