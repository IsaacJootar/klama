<?php

namespace App\Livewire\Reservations;

use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Roomallocation;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\SalesCoupon;
use App\Models\Bank;
use App\Http\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

#[Title('Reservations | Room Search')]

class Reservations extends Component
{
    public $allocations;
    public $checkin = '';
    public $checkout = '';
    public $category_id;
    public $nor = '';
    public $selectedRooms = [];
    public $fullname;
    public $phone;
    public $email;
    public $address;
    public $requests;
    public $coupon_code = '';
    public $coupon_discount = 0;
    public $coupon_applied = false;
    public $receiving_bank = '';
    public $banks = [];
    public $activeModal = '';

    public function mount()
    {
        $this->checkin = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
        $this->checkout = Carbon::now()->timezone('Africa/Lagos')->addDays(1)->format('Y-m-d');
        $this->banks = Bank::select('id', 'bank_name')->get()->toArray();
        $this->refreshAllocations();
        session()->put('checkin', $this->checkin);
        session()->put('checkout', $this->checkout);
        session()->put('token', 1);
    }

    #[On('refresh-room-allocations')]
    public function refreshRoomAllocations($checkin, $checkout)
    {
        $this->checkin = $checkin;
        $this->checkout = $checkout;
        $this->selectedRooms = [];
        $this->refreshAllocations();
        session()->put('checkin', $this->checkin);
        session()->put('checkout', $this->checkout);
        session()->put('token', 2);
    }

    private function refreshAllocations()
    {
        $cart = session('bulk_cart', []);
        $this->allocations = Roomallocation::where('category_id', '!=', null)
            ->with('category')
            ->distinct()
            ->get(['category_id']);

        foreach ($this->allocations as $allocation) {
            $category_id = $allocation->category_id;
            $cart_items = collect($cart)->where('category_id', $category_id);

            $base_available = Roomallocation::where('category_id', $category_id)
                ->where(function ($query) {
                    $query->whereNotBetween('checkin', [$this->checkin, $this->checkout])
                          ->whereNotBetween('checkout', [$this->checkin, $this->checkout])
                          ->orWhereNull('checkin')
                          ->orWhereNull('checkout');
                })
                ->count();

            $cart_rooms = 0;
            foreach ($cart_items as $item) {
                $overlap = Roomallocation::where('category_id', $category_id)
                    ->where(function ($query) use ($item) {
                        $query->whereBetween('checkin', [$item['checkin'], $item['checkout']])
                              ->orWhereBetween('checkout', [$item['checkin'], $item['checkout']])
                              ->orWhere(function ($query) use ($item) {
                                  $query->where('checkin', '<=', $item['checkin'])
                                        ->where('checkout', '>=', $item['checkout']);
                              });
                    })
                    ->count();
                $cart_rooms += $item['nor'];
            }

            $allocation->available_count = max(0, $base_available - $cart_rooms);
        }
    }

    public function addToCart($category_id, $index, $available_count)
    {
        $this->activeModal = "addToListModal-{$index}";
        $nor = $this->selectedRooms[$index] ?? 1;
        $checkin = $this->checkin;
        $checkout = $this->checkout;

        // Validate dates
        if (Carbon::parse($checkin)->gte(Carbon::parse($checkout))) {
            toastr()->warning('Check-out date must be after check-in date.');
            $this->dispatch('force-refresh');
            return;
        }

        // Check actual available rooms
        $actual_available = Roomallocation::where('category_id', $category_id)
            ->where(function ($query) use ($checkin, $checkout) {
                $query->whereNotBetween('checkin', [$checkin, $checkout])
                      ->whereNotBetween('checkout', [$checkin, $checkout])
                      ->orWhereNull('checkin')
                      ->orWhereNull('checkout');
            })
            ->count();

        $cart = session('bulk_cart', []);
        $cart_rooms_for_category = collect($cart)
            ->where('category_id', $category_id)
            ->where('checkin', $checkin)
            ->where('checkout', $checkout)
            ->sum('nor');

        if ($nor + $cart_rooms_for_category > $actual_available) {
            toastr()->warning('Total number of rooms exceeds available rooms for this category and date range.');
            $this->dispatch('force-refresh');
            return;
        }

        $price = Roomallocation::where('category_id', $category_id)->value('price');
        if (!$price || $price <= 0) {
            toastr()->warning('Invalid room price.');
            $this->dispatch('force-refresh');
            return;
        }

        $cart[] = [
            'category_id' => $category_id,
            'nor' => $nor,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'price' => $price,
        ];

        session()->put('bulk_cart', $cart);
        $this->refreshAllocations();
        toastr()->info("{$nor} room(s) added to reservation list.");
        $this->dispatch('modal:keep-open', modalId: "addToListModal-{$index}");
    }

    public function removeFromCart($index)
    {
        $this->activeModal = 'viewListModal';
        $cart = session('bulk_cart', []);
        if (isset($cart[$index])) {
            unset($cart[$index]);
            session()->put('bulk_cart', array_values($cart));
            $this->refreshAllocations();
            toastr()->info('Room removed from reservation list.');
            $this->dispatch('modal:keep-open', modalId: 'viewListModal');
        }
    }

    public function updateCartQuantity($index, $newNor, $available_count)
    {
        $this->activeModal = 'viewListModal';
        $cart = session('bulk_cart', []);
        if (isset($cart[$index])) {
            $category_id = $cart[$index]['category_id'];
            $checkin = $cart[$index]['checkin'];
            $checkout = $cart[$index]['checkout'];

            $actual_available = Roomallocation::where('category_id', $category_id)
                ->where(function ($query) use ($checkin, $checkout) {
                    $query->whereNotBetween('checkin', [$checkin, $checkout])
                          ->whereNotBetween('checkout', [$checkin, $checkout])
                          ->orWhereNull('checkin')
                          ->orWhereNull('checkout');
                })
                ->count();

            $cart_rooms_for_category = collect($cart)
                ->where('category_id', $category_id)
                ->where('checkin', $checkin)
                ->where('checkout', $checkout)
                ->except($index)
                ->sum('nor');

            if ($newNor + $cart_rooms_for_category > $actual_available) {
                toastr()->warning('Total number of rooms exceeds available rooms for this category and date range.');
                $this->dispatch('modal:keep-open', modalId: 'viewListModal');
                return;
            }

            if ($newNor < 1) {
                toastr()->warning('Number of rooms must be at least 1.');
                $this->dispatch('modal:keep-open', modalId: 'viewListModal');
                return;
            }

            $cart[$index]['nor'] = $newNor;
            session()->put('bulk_cart', array_values($cart));
            $this->refreshAllocations();
            toastr()->info('Room quantity updated.');
            $this->dispatch('modal:keep-open', modalId: 'viewListModal');
        }
    }

    public function clearBulkCart()
    {
        $this->activeModal = 'viewListModal';
        session()->forget('bulk_cart');
        $this->coupon_code = '';
        $this->coupon_discount = 0;
        $this->coupon_applied = false;
        $this->receiving_bank = '';
        $this->refreshAllocations();
        toastr()->info('Reservation list cleared.');
        $this->dispatch('modal:keep-open', modalId: 'viewListModal');
    }

    public function applyCoupon()
    {
        $this->activeModal = 'viewListModal';
        if (empty($this->coupon_code)) {
            toastr()->warning('Please enter a coupon code.');
            $this->dispatch('modal:keep-open', modalId: 'viewListModal');
            return;
        }

        $coupon = SalesCoupon::where('code', $this->coupon_code)->first();

        if (!$coupon) {
            toastr()->warning('Invalid coupon code.');
            $this->dispatch('modal:keep-open', modalId: 'viewListModal');
            return;
        }

        if ($coupon->usage_count >= 1) {
            toastr()->warning('Coupon has already been used.');
            $this->dispatch('modal:keep-open', modalId: 'viewListModal');
            return;
        }

        if (Carbon::parse($coupon->end_date)->isPast() || Carbon::parse($coupon->start_date)->isFuture()) {
            toastr()->warning('Coupon is expired or not yet active.');
            $this->dispatch('modal:keep-open', modalId: 'viewListModal');
            return;
        }

        $cart = session('bulk_cart', []);
        if (empty($cart)) {
            toastr()->warning('Reservation list is empty.');
            $this->dispatch('modal:keep-open', modalId: 'viewListModal');
            return;
        }

        $total_rooms = collect($cart)->sum('nor');
        $this->coupon_discount = $coupon->discount_value / $total_rooms;
        $this->coupon_applied = true;
        toastr()->info('Coupon applied successfully.');
        $this->dispatch('modal:keep-open', modalId: 'viewListModal');
    }

    public function submitBulkReservation()
    {
        $this->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'email' => 'nullable|email:rfc|max:255',
            'address' => 'nullable|string|max:500',
            'requests' => 'nullable|string|max:1000',
            'coupon_code' => 'nullable|string|max:50',
            'receiving_bank' => 'required|exists:banks,id',
        ], [
            'fullname.required' => 'Customer fullname is required.',
            'phone.required' => 'Contact number is required.',
            'phone.numeric' => 'Contact number must be numeric.',
            'email.email' => 'Invalid email format.',
            'receiving_bank.required' => 'Please select a bank.',
            'receiving_bank.exists' => 'Invalid bank selection.',
        ]);

        $cart = session('bulk_cart', []);
        if (empty($cart)) {
            toastr()->warning('Reservation list is empty.');
            $this->dispatch('modal:keep-open', modalId: 'viewListModal');
            return;
        }

        $reservation_id = mt_rand(10000000, 99999999);
        $total_rooms = collect($cart)->sum('nor');
        $total_amount = 0;
        $user = Auth::user()->id ?? null;

        try {
            DB::transaction(function () use ($cart, $reservation_id, $total_rooms, $user, &$total_amount) {
                $coupon = $this->coupon_applied ? SalesCoupon::where('code', $this->coupon_code)->first() : null;

                foreach ($cart as $item) {
                    $category_id = $item['category_id'];
                    $nor = $item['nor'];
                    $checkin = $item['checkin'];
                    $checkout = $item['checkout'];
                    $price = $item['price'];

                    $available_rooms = Roomallocation::where('category_id', $category_id)
                        ->where(function ($query) use ($checkin, $checkout) {
                            $query->whereNotBetween('checkin', [$checkin, $checkout])
                                  ->whereNotBetween('checkout', [$checkin, $checkout])
                                  ->orWhereNull('checkin')
                                  ->orWhereNull('checkout');
                        })
                        ->limit($nor)
                        ->get();

                    if ($available_rooms->count() < $nor) {
                        throw new \Exception('Not enough available rooms for category ID: ' . $category_id);
                    }

                    foreach ($available_rooms as $room) {
                        $room_total = Helper::get_total_amount_due_plain($checkin, $checkout, $category_id, 1);
                        if ($this->coupon_applied && $coupon) {
                            $room_total = max(0, $room_total - $this->coupon_discount);
                        }
                        $total_amount += $room_total;

                        Reservation::create([
                            'user_id' => $user,
                            'category_id' => $category_id,
                            'room_id' => $room->room_id,
                            'medium' => 'Front Desk',
                            'nor' => $total_rooms,
                            'unit_price' => $price,
                            'total_amount' => $room_total,
                            'coupon_code' => $this->coupon_applied ? $this->coupon_code : null,
                            'fullname' => $this->fullname,
                            'email' => $this->email,
                            'phone' => $this->phone,
                            'address' => $this->address,
                            'requests' => $this->requests,
                            'checkin' => $checkin,
                            'checkout' => $checkout,
                            'reservation_id' => $reservation_id,
                            'status' => 'Open',
                            'payment_status' => 'Paid',
                            'checkin_status' => 'Pending',
                            'checkin_type' => 'Standard',
                            'early_checkin_fee' => 0,
                            'checkout_status' => 'Pending',
                            'checkout_type' => 'Standard',
                            'late_checkout_fee' => 0,
                            'confirmation_note' => null,
                            'bank_id' => $this->receiving_bank,
                        ]);

                        Roomallocation::where('room_id', $room->room_id)->update([
                            'checkin' => $checkin,
                            'checkout' => $checkout,
                            //'status' => 'Occupied',
                        ]);
                    }
                }
                
                
               /* 
                $reservation = Reservation::where('reservation_id', $reservation_id)->first();
        $email = $reservation->email ?: 'vinegrouphouse@gmail.com';
        $subject = 'Reservation Confirmed';
        $message = 'Your Reservation has been confirmed. 
        Welcome to VINE INTERNATIONAL SUITES AND RESORT, your home away from home!
        Here, every moment of your stay is cherished, and we make it memorable.
        Be rest assured that you’ll have a wonderful experience.';
        $sendmail = app(abstract: EmailMessageService::class);
        $sendmail->ComfirmReservationEmail($message, $email, $subject);
        */
                if ($coupon) {
                    $coupon->increment('usage_count');
                }
            });
            

            session()->forget('bulk_cart');
            $this->coupon_code = '';
            $this->coupon_discount = 0;
            $this->coupon_applied = false;
            $this->receiving_bank = '';
            $this->activeModal = '';

            toastr()->info('Bulk reservation created successfully with payment confirmed.');
            return to_route('reserved-rooms');
        } catch (\Exception $e) {
            
            toastr()->warning('Failed to create reservation. Please try again.');
            $this->dispatch('modal:keep-open', modalId: 'viewListModal');
        }
    }

    public function render()
    {
        return view('livewire.reservations.reservations')
            ->layout('layouts.reservations');
    }
}