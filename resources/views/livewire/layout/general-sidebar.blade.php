<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
<<<<<<< HEAD
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
=======


    <div class="app-brand demo ">
      <a href="index-2.html" class="app-brand-link">
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
        <span class="app-brand-text demo menu-text fw-bold">Hotelis</span>
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
          <div data-i18n="MANAGE USERS">MANAGE USERS </div>
        </a>
        <ul class="menu-sub">
            <x-active-menu-items :active="request()->is('general/createuser-account')"></x-active-menu-items>
            <a href="/general/createuser-account"  class="menu-link" >
              <div data-i18n="Create Account">Create Account </div>
            </a>
          </li>

          <x-active-menu-items :active="request()->is('general/hotel-sections')"></x-active-menu-items>
            <a href="/general/hotel-sections"  class="menu-link" >
              <div data-i18n="Hotel-Section">Hotel Sections  </div>
            </a>
          </li>

          <x-active-menu-items :active="request()->is('general/system-roles')"></x-active-menu-items>
            <a href="/general/system-roles"  class="menu-link" >
              <div data-i18n="system Roles">System Roles</div>
            </a>
          </li>

          <x-active-menu-items :active="request()->is('')"></x-active-menu-items>
    <a href="#" class="menu-link">
              <div data-i18n="Roles & Permissions">Roles & Permissions </div>
            </a>
          </li>
            </ul>
          </li>
     <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons fa-solid fa-building"></i>
          <div data-i18n="RESERVATIONS">RESERVATIONS</div>
        </a>
        <ul class="menu-sub">

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
          <x-active-menu-items :active="request()->is('reservations/available-rooms')"></x-active-menu-items>
          <a href="/reservations/available-rooms" class="menu-link" >
          Available Rooms
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

      <x-active-menu-items :active="request()->is('')"></x-active-menu-items>
      <a href="#" class="menu-link">
    Verify Reservation ID
      </a>
    </li>
    <x-active-menu-items :active="request()->is('')"></x-active-menu-items>
    <a href="#" class="menu-link">
  Abandoned Reservations
    </a>
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
              <i class='menu-icon ti ti-truck'></i>
              <div data-i18n="LOGISTICS">LOGISTICS</div>
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


          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class='menu-icon ti ti-menu'></i>
              <div data-i18n="MAINTENANCE">MAINTENANCE</div>
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


              <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class='menu-icon ti ti-layout'></i>
                  <div data-i18n="HOUSEKEEPING">HOUSEKEEPING</div>
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


          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class='menu-icon fa-solid fa-kitchen-set'></i>
              <div data-i18n="KITCHE & RESTAURANTS">KITCHE & RESTAURANTS</div>
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


        </ul>
      </li>




  </aside>
  <!-- / Menu -->
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
