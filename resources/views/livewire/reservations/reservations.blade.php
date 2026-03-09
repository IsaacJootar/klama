<div class="container-xxl flex-grow-1 container-p-y">
    <livewire:reservations.search-reservations>
    <form id="wizard-checkout-form" onSubmit="return false">
        @php
            use Carbon\Carbon;
            use Illuminate\Support\Facades\Storage;
            use App\Http\Helpers\Helper;
            if (session()->get('token') == 1) {
                $checkin = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
                $checkout = Carbon::now()->addDays(1)->timezone('Africa/Lagos')->format('Y-m-d');
            }
            if (session()->get('token') == 2) {
                $checkin = session('checkin');
                $checkout = session('checkout');
            }
        @endphp

        <h6 class="pb-1 mb-4">
            <span class="badge rounded-pill bg-label-info">
                Available rooms: <strong>{{ Carbon::parse($checkin)->format('M d, Y') }} - {{ Carbon::parse($checkout)->format('M d, Y') }}</strong>
            </span>
            @if(session()->has('bulk_cart') && count(session('bulk_cart')) > 0)
                <small>(Availability adjusted for cart items)</small>
            @endif
        </h6>

        @if(session()->has('bulk_cart') && count(session('bulk_cart')) > 0)
        <div class="text-end mb-3">
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewListModal">
                View Reservation List
            </button>
        </div>
        @endif

<<<<<<< HEAD
        <!-- View List Modal -->
        <div class="modal fade" id="viewListModal" tabindex="-1" aria-labelledby="viewListModalLabel" aria-hidden="true" wire:ignore.self>
          
                <div class="modal-dialog  modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                     <div class="modal-header ">
                        <h4 class="modal-title" id="viewListModalLabel">  <span class="badge bg-label-primary">Manage Reservation & Checkout</span></h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
=======
    <div class="container-xxl flex-grow-1 container-p-y">
        <livewire:reservations.search-reservations>
            <!--/ search-label component -->
            <form id="wizard-checkout-form" onSubmit="return false">
                @php
                          use Carbon\Carbon;
                          use Illuminate\Support\Facades\Storage;

                        if (session()->get('token') == 1){// from index
                          $checkin=Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
                          $checkout=Carbon::now()->addDays(1)->timezone('Africa/Lagos')->format('Y-m-d'); // working with dates is exhuasting
                         }

                         if (session()->get('token') == 2){ //from search
                          $checkin= session('checkin');
                          $checkout=session('checkout');
                         }


                @endphp
                <!-- Reservation search results starts -->
                <h6 class="pb-1 mb-6"><span class="badge rounded-pill bg-label-info">Available rooms below are from time period:  <strong>   {{$checkin}} -  {{ $checkout}} </strong> You can search again using different dates above</span></h6>

<!-- Website Analytics -->


<div class="col-lg-5">
    <div class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg"
      id="swiper-with-pagination-cards">

      <div class="swiper-wrapper">

        <div class="swiper-slide">

          <div class="row">

            
          </div>


        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
  <!--/ Website Analytics -->
                <div class="row mb-12 g-6">
                    @foreach ($allocations as $allocation)
                  <div class="col-md">
                    <div class="card">
                      <div class="row g-0">
                        <div class="col-md-4">
                          <img class="card-img card-img-left" src="{{ Storage::url('category-images/'.$allocation->category->image) }}"  alt="Card image" />
                        </div>
                        <div class="col-md-8">

                          <div class="card-body">
                            <h4 class="card-title"> <span class="badge bg-label-primary"> {{ $allocation->category->category}}</span></h4>
                            <h6 class="card-title">  {{$count=\App\Models\Roomallocation::where('category_id', $allocation->category->id)
                            ->whereNotBetween('checkin', [session('checkin'), session('checkout')])
                            ->whereNotBetween('checkout', [session('checkin'), session('checkout')] )
                            ->get()->count()}} Available Room (s) </h6>
                            <p class="card-text">
                                {{ $allocation->category->details}}

                            </p>
                              <br/>
                                <h6 class="mb-1">Special Offers</h6>
                                 <!-- Specials-make this dynamic later and allow managers add at will -->
                                <p>
                                <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 my-2">
                                    <li class="list-inline-item d-flex gap-2 align-items-center">
                                        @php if($allocation->category->wifi == 1){ echo '<i class="fas fa-wifi"></i>'.' <span class="fw-medium">WiFi</span>';} @endphp
                                      </li>
                                      <li class="list-inline-item d-flex gap-2 align-items-center">
                                        @php if($allocation->category->breakfast == 1){ echo '<i class="fas fa-coffee"></i>'.' <span class="fw-medium">Breakfast</span>';} @endphp
                                    </li>
                                    <li class="list-inline-item d-flex gap-2 align-items-center">
                                        @php if($allocation->category->lunch == 1){ echo '<i class="fas fa-concierge-bell"></i>'.' <span class="fw-medium">Lunch</span>';} @endphp
                                    </li>
                                    <li class="list-inline-item d-flex gap-2 align-items-center">
                                        @php if($allocation->category->laundry == 1){ echo '<i class="fas fa-tshirt"></i>'.' <span class="fw-medium">Laundry </span>';} @endphp
                                    </li>



                                  </ul>
                                </p>


                            </p> <br/>
                            <h6 class="mb-1">Price: {{Helper::format_currency(\App\Models\Roomallocation::where('category_id', $allocation->category_id)->get()->value('price'))}}
                                <h6 class="mb-1">Per Night (Inc. Tax ) </h6>
                        </h6>  <br/>
                       <x-primary-button a href="{{route('create-reservation', ['category_id' => $allocation->category_id, 'nor'=> $count, 'checkin'=> $checkin, 'checkout'=> $checkout])}}" wire:navigate>
                          Reserve Now <i class="ti ti-arrow-right scaleX-n1-rtl ti-sm me-1_5"></i></x-primary-button>
                          </div>
                        </div>
                        @endforeach

                      </div>
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
                    </div>
                    <div class="modal-body p-4">
                        @php
                            $cart = session('bulk_cart', []);
                            $total_rooms = collect($cart)->sum('nor');
                            $subtotal = 0;
                            $category_counts = collect($cart)->groupBy('category_id')->map->sum('nor');
                            foreach ($cart as $item) {
                                $subtotal += Helper::get_total_amount_due_plain($item['checkin'], $item['checkout'], $item['category_id'], $item['nor']);
                            }
                            $discount = $coupon_applied ? ($coupon_discount * $total_rooms) : 0;
                            $total_amount = max(0, $subtotal - $discount);
                            $reservation_id = mt_rand(10000000, 99999999);

                            // Group cart items by checkin and checkout dates
                            $grouped_cart = collect($cart)->groupBy(function ($item) {
                                return $item['checkin'] . '|' . $item['checkout'];
                            })->map(function ($items) {
                                return $items->groupBy('category_id')->map(function ($category_items) {
                                    return [
                                        'nor' => $category_items->sum('nor'),
                                        'price' => $category_items->first()['price'],
                                        'checkin' => $category_items->first()['checkin'],
                                        'checkout' => $category_items->first()['checkout'],
                                        'indices' => $category_items->keys()->toArray(),
                                        'category_id' => $category_items->first()['category_id'],
                                    ];
                                })->values();
                            })->values();
                        @endphp

                        @if (!empty($cart))
                        <div class="row g-4">
                            <div class="col-lg-7">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h4 class="card-title mb-3">Reservation Summary (ID: {{$reservation_id}})</h4>
                                        <p class="text-muted mb-4">Manage your cart and complete checkout.</p>
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Category</th>
                                                        <th>Customer</th>
                                                        <th>Contact</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            @php
                                                                $badgeClasses = ['bg-primary', 'bg-secondary', 'bg-dark'];
                                                                $i = 0;
                                                                foreach ($category_counts as $category_id => $count) {
                                                                    $categoryName = \App\Models\Roomcategory::where('id', $category_id)->value('category') ?? 'N/A';
                                                                    $badgeClass = $badgeClasses[$i % count($badgeClasses)];
                                                                    echo "<span class=\"badge $badgeClass text-white me-2 mb-2\">$categoryName: $count</span>";
                                                                    $i++;
                                                                }
                                                            @endphp
                                                        </td>
                                                        <td>{{ $fullname ?: 'N/A' }}</td>
                                                        <td>{{ $phone ?: 'N/A' }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <th>Email</th>
                                                        <th>Channel</th>
                                                        <th>Address</th>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $email ?: 'N/A' }}</td>
                                                        <td>Front Desk</td>
                                                        <td>{{ Str::of($address)->limit(50) ?: 'N/A' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <h5 class="mt-4 mb-3">Cart Details</h5>
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Check-in</th>
                                                        <th>Check-out</th>
                                                        <th>Category</th>
                                                        <th>Rooms</th>
                                                        <th>Price/Night</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($grouped_cart as $date_group)
                                                        @foreach ($date_group as $item)
                                                            @php
                                                                $categoryName = \App\Models\Roomcategory::where('id', $item['category_id'])->value('category') ?? 'N/A';
                                                                $available_count = \App\Models\Roomallocation::where('category_id', $item['category_id'])
                                                                    ->where(function ($query) use ($item) {
                                                                        $query->whereNotBetween('checkin', [$item['checkin'], $item['checkout']])
                                                                              ->whereNotBetween('checkout', [$item['checkin'], $item['checkout']])
                                                                              ->orWhereNull('checkin')
                                                                              ->orWhereNull('checkout');
                                                                    })
                                                                    ->count();
                                                            @endphp
                                                            <tr>
                                                                <td>{{ Carbon::parse($item['checkin'])->format('M d, Y') }}</td>
                                                                <td>{{ Carbon::parse($item['checkout'])->format('M d, Y') }}</td>
                                                                <td>{{ $categoryName }}</td>
                                                                <td>
                                                                    <select class="form-select" wire:change="updateCartQuantity({{ $item['indices'][0] }}, $event.target.value, {{ $available_count }})">
                                                                        @for ($i = 1; $i <= $available_count; $i++)
                                                                            <option value="{{ $i }}" {{ $item['nor'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                                        @endfor
                                                                    </select>
                                                                </td>
                                                                <td>{{ Helper::format_currency($item['price']) }}</td>
                                                                <td>
                                                                    <button class="btn btn-outline-danger btn-sm" wire:loading.attr="disabled" wire:click="removeFromCart({{ $item['indices'][0] }})">
                                                                        Remove
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h4 class="card-title mb-3">Order Summary</h4>
                                        <p class="text-muted"><i class="badge bg-label-success">{{ Carbon::now()->format('M d, Y') }}</i></p>
                                        <div class="p-3 bg-light rounded mb-4">
                                            @foreach ($category_counts as $category_id => $count)
                                            <div class="d-flex justify-content-between mb-3">
                                                <h6>{{ \App\Models\Roomcategory::where('id', $category_id)->value('category') }} ({{ $count }})</h6>
                                                <h6>{{ Helper::format_currency(\App\Models\Roomallocation::where('category_id', $category_id)->value('price')) }}/Night</h6>
                                            </div>
                                            @endforeach
                                        </div>
                                        <h5 class="mb-3">Coupon Offer</h5>
                                        <div class="row g-2 mb-4">
                                            <div class="col-8">
                                                <input wire:model="coupon_code" type="text" class="form-control" placeholder="Enter Coupon Code">
                                                @error('coupon_code') <span class="text-danger small">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="col-4">
                                                <button type="button" class="btn btn-primary w-100" wire:loading.attr="disabled" wire:click="applyCoupon">Apply</button>
                                            </div>
                                        </div>
                                        @if ($coupon_applied)
                                        <div class="d-flex justify-content-between mb-3">
                                            <p class="mb-0">Coupon ({{ $coupon_code }})</p>
                                            <h6 class="mb-0">-{{ Helper::format_currency($discount) }}</h6>
                                        </div>
                                        @endif
                                        <div class="d-flex justify-content-between mb-3">
                                            <p class="mb-0">Quantity</p>
                                            <h6 class="mb-0">{{ $total_rooms }} Room(s)</h6>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3">
                                            <p class="mb-0">Subtotal</p>
                                            <h6 class="mb-0">{{ Helper::format_currency(max(0, $subtotal)) }}</h6>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3">
                                            <p class="mb-0">Tax</p>
                                            <h6 class="mb-0"><i class="badge bg-label-success">inclusive</i></h6>
                                        </div>
                                        <hr class="my-4">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="mb-0">Total</h5>
                                            <h5 class="mb-0">{{ Helper::format_currency($total_amount) }}</h5>
                                        </div>
                                        <form>
                                            @csrf
                                            <div class="mt-4">
                                                <h5 class="mb-3">Bank Details</h5>
                                                <select wire:model="receiving_bank" id="bankSelect" class="form-select mb-3" required>
                                                    <option value="">--Select Bank--</option>
                                                    @foreach ($banks as $bank)
                                                        <option value="{{ $bank['id'] }}">{{ $bank['bank_name'] }}</option>
                                                    @endforeach
                                                </select>
                                                @error('receiving_bank') <span class="text-danger small">{{ $message }}</span> @enderror
                                                <h5 class="mb-3 mt-4">Guest Information</h5>
                                                <input wire:model.defer="fullname" type="text" class="form-control mb-3" placeholder="Full Name" required>
                                                @error('fullname') <span class="text-danger small">{{ $message }}</span> @enderror
                                                <input wire:model.defer="phone" type="text" class="form-control mb-3" placeholder="Phone" required>
                                                @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                                                <input wire:model.defer="email" type="email" class="form-control mb-3" placeholder="Email (optional)">
                                                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                                                <input wire:model.defer="address" type="text" class="form-control mb-3" placeholder="Address (optional)">
                                                @error('address') <span class="text-danger small">{{ $message }}</span> @enderror
                                                <textarea wire:model.defer="requests" class="form-control mb-3" rows="3" placeholder="Special Requests (optional)"></textarea>
                                                @error('requests') <span class="text-danger small">{{ $message }}</span> @enderror
                                                
                                                <div class="d-flex justify-content-between mt-4">
                                                    <button type="button" class="btn btn-outline-secondary" wire:loading.attr="disabled" wire:click="clearBulkCart">Clear Cart</button>
                                                   <a wire:click="submitBulkReservation"
                                               wire:confirm="Are you sure you want to proceed and confirm this payment?">
                                                <button class="btn btn-success">
                                                    <span style="color: white" class="me-2">Confirm this Payment</span>
                                                </button>
                                            </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="alert alert-warning mb-0">Your reservation list is empty.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--/ View List Modal -->

        <div class="row mb-12 g-6">
            @foreach ($allocations as $index => $allocation)
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <div class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg" id="swiper-{{ $index }}">
                                <div class="swiper-wrapper">
                                    @php
                                        $files = \App\Models\CategoryImage::where('category', $allocation->category->category)->get();
                                    @endphp
                                    @foreach ($files as $file)
                                    <div class="swiper-slide text-center">
                                        <img class="card-img" src="{{ asset('public/storage/category-images/'.$file->random_name) }}" alt="Hotel Category images" height="200" />
                                    </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <span class="badge bg-label-primary">{{ $allocation->category->category }}</span>
                                </h4>
                                <h6 class="card-title">
                                    {{ $allocation->available_count ?? \App\Models\Roomallocation::where('category_id', $allocation->category->id)
                                        ->where(function ($query) use ($checkin, $checkout) {
                                            $query->whereNotBetween('checkin', [$checkin, $checkout])
                                                  ->whereNotBetween('checkout', [$checkin, $checkout])
                                                  ->orWhereNull('checkin')
                                                  ->orWhereNull('checkout');
                                        })
                                        ->count() }} Available Room(s)
                                </h6>
                                
                                <p class="card-text">{{ $allocation->category->details }}</p>
                                <h6 class="mb-1">Price: {{ Helper::format_currency(\App\Models\Roomallocation::where('category_id', $allocation->category_id)->value('price')) }}</h6>
                                <h6 class="mb-1">Per Night (Inc. Tax)</h6>
                                <br/>
                                <div class="d-flex justify-content-between align-items-center">
                                    <x-primary-button a href="{{route('create-reservation', ['category_id' => $allocation->category_id, 'nor' => $allocation->available_count ?? 1, 'checkin' => $checkin, 'checkout' => $checkout])}}" wire:navigate>
                                        Reserve Now <i class="ti ti-arrow-right scaleX-n1-rtl ti-sm me-1_5"></i>
                                    </x-primary-button>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addToListModal-{{ $index }}">
                                            Add Room(s) to List
                                        </button>
                                        <div class="fw-bold" style="font-size: 0.75rem; margin-top: 2px;">for bulk reservations</div>
                                    </div>
                                </div>

                                <!-- Add to List Modal -->
                                <div class="modal fade" id="addToListModal-{{ $index }}" tabindex="-1" aria-labelledby="addToListModalLabel-{{ $index }}" aria-hidden="true" wire:ignore.self>
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addToListModalLabel-{{ $index }}">Add to Bulk Reservation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-striped table-bordered mb-3">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row" style="width: 45%;">Category</th>
                                                            <td>{{ $allocation->category->category }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Available</th>
                                                            <td>{{ $allocation->available_count ?? \App\Models\Roomallocation::where('category_id', $allocation->category->id)
                                        ->where(function ($query) use ($checkin, $checkout) {
                                            $query->whereNotBetween('checkin', [$checkin, $checkout])
                                                  ->whereNotBetween('checkout', [$checkin, $checkout])
                                                  ->orWhereNull('checkin')
                                                  ->orWhereNull('checkout');
                                        })
                                        ->count() }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Check-in</th>
                                                            <td>{{ Carbon::parse($checkin)->format('M d, Y') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Check-out</th>
                                                            <td>{{ Carbon::parse($checkout)->format('M d, Y') }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="mb-3">
                                                    <label for="numRooms-{{ $index }}" class="form-label">Number of Rooms</label>
                                                    <select class="form-select" id="numRooms-{{ $index }}" wire:model="selectedRooms.{{ $index }}">
                                                        @for ($i = 1; $i <= ($allocation->available_count ?? \App\Models\Roomallocation::where('category_id', $allocation->category->id)
                                        ->where(function ($query) use ($checkin, $checkout) {
                                            $query->whereNotBetween('checkin', [$checkin, $checkout])
                                                  ->whereNotBetween('checkout', [$checkin, $checkout])
                                                  ->orWhereNull('checkin')
                                                  ->orWhereNull('checkout');
                                        })
                                        ->count()); $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                    @error("selectedRooms.{$index}") <span class="text-danger small">{{ $message }}</span> @enderror
                                                </div>
                                                <button type="button" class="btn btn-primary w-100" wire:loading.attr="disabled" wire:click="addToCart({{ $allocation->category_id }}, {{ $index }}, {{ $allocation->available_count ?? 1 }})">
                                                    +Add to List
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Add to List Modal -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', function () {
        // Configure toastr
        toastr.options = {
            preventDuplicates: true,
            closeButton: true,
            timeOut: 5000,
            extendedTimeOut: 2000,
            tapToDismiss: false,
            positionClass: 'toast-top-right',
            onShown: function () {
                // Re-open active modal
                const activeModalId = @json($activeModal);
                if (activeModalId) {
                    setTimeout(() => {
                        const modalEl = document.getElementById(activeModalId);
                        if (modalEl) {
                            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                            if (!modal._isShown) {
                                modal.show();
                            }
                        }
                    }, 100);
                }
            }
        };

        // Maintain modal state after Livewire updates
        Livewire.on('update', () => {
            const activeModalId = @json($activeModal);
            if (activeModalId) {
                setTimeout(() => {
                    const modalEl = document.getElementById(activeModalId);
                    if (modalEl) {
                        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                        if (!modal._isShown) {
                            modal.show();
                        }
                    }
                }, 100);
            }
        });

        // Handle modal:keep-open
        Livewire.on('modal:keep-open', ({ modalId }) => {
            setTimeout(() => {
                const modalEl = document.getElementById(modalId);
                if (modalEl) {
                    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                    if (!modal._isShown) {
                        modal.show();
                    }
                }
            }, 100);
        });

        // Force page refresh on error with fallback
        Livewire.on('force-refresh', () => {
            try {
                window.location.reload(true);
            } catch (e) {
                console.error('Force refresh failed:', e);
                window.location.href = window.location.href;
            }
        });

        // Initialize Swiper
        document.querySelectorAll(".swiper-container").forEach((swiperEl) => {
            if (!swiperEl.swiper) {
                new Swiper("#" + swiperEl.id, {
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                });
            }
        });
    });
</script>
@endpush