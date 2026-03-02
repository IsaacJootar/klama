<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


    <div class="app-brand demo ">
      <a href="/sales/sales-dashboard" class="app-brand-link">
       
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
          <div data-i18n="SALES & MARKETING">SALES & MARKETING</div>
        </a>
        <ul class="menu-sub">

                <x-active-menu-items :active="request()->is('sales/coupon')"></x-active-coupon-items>
                <a href="/sales/coupon" class="menu-link" >
                    Coupons
                </a>
                </li>

            <x-active-menu-items :active="request()->is('sales/campaign')"></x-active-menu-items>
                <a href="/sales/campaign" class="menu-link" >
                Campaigns
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

                <x-active-menu-items :active="request()->is('#')"></x-active-menu-items>
                <a href="#" class="menu-link">
                    Inventory Categories
                </a>
                </li>
                <x-active-menu-items :active="request()->is('#')"></x-active-menu-items>
                <a href="#" class="menu-link">
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
              <x-active-menu-items :active="request()->is('#')"></x-active-menu-items>
              <a  href="#"  class="menu-link" >
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
