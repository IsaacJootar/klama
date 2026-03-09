<?php

namespace App\Livewire\Fnb;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\FnbOrder;
use App\Models\FnbMenu;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str; // Ensure Str is imported

#[Title('Food & Beverage | Make Restaurant Order')]
class Order extends Component
{
    #[Validate('required|exists:fnb_menus,name')]
    public $order_name = '';

    #[Validate('required|date')]
    public $order_date = '';

    #[Validate('required|integer|min:1')]
    public $quantity = 1;

    public $order_code = '';
    public $modal_title = 'Make an Order';
    public $cart = [];
    public $printCart = [];
    public $printOrderCode = ''; // Add this for printing
    public $printTotalAmount = 0; // Add this for printing
    public $totalAmount = 0;
    public $menus;
    public $printOrder = false;
    
    // Receipt properties
    public $receiptOrderCode = '';
    public $receiptItems = [];
    public $receiptTotalAmount = 0;
    public $showReceiptModal = false;
    
    // sales    
    public $salesData = [];
    public $salesFromDate = '';
    public $salesToDate = '';

    public function mount()
    {
        // Initialize cart, order_code, and order_date from session
        $userId = Auth::id();
        $this->cart = session("cart_{$userId}", []);
        $this->order_code = session("order_code_{$userId}", '');
        // Load order_date from session, default to today if not set
        $this->order_date = session("order_date_{$userId}", Carbon::now()->format('Y-m-d'));
        $this->updateTotalAmount();
        $this->menus = FnbMenu::all();
        
        // Initialize sales data
        $this->salesFromDate = Carbon::now()->startOfWeek()->format('Y-m-d');
        $this->salesToDate = Carbon::now()->format('Y-m-d');
        $this->refreshSalesData();
    }

    private function generateOrderCode()
    {
        $randomCode = '';
        for ($i = 0; $i < 14; $i++) {
            $randomCode .= mt_rand(0, 9);
        }
        return $randomCode;
    }

    public function addToCart()
    {
        // Use session order_date if set and not overridden
        if (empty($this->order_date) && session()->has("order_date_" . Auth::id())) {
            $this->order_date = session("order_date_" . Auth::id());
        }

        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('refresh-tom-select'); // Ensure Tom Select reinitializes on validation failure
            throw $e; // Re-throw to let Livewire handle validation errors
        }

        // Fetch menu details
        $menu = FnbMenu::where('name', $this->order_name)->first();
        if (!$menu) {
            toastr()->error('Selected menu item not found.');
            $this->dispatch('refresh-tom-select');
            return;
        }

        // Generate order_code if empty
        if (empty($this->order_code)) {
            $this->order_code = $this->generateOrderCode();
        }

        // Add item to cart
        $this->cart[] = [
            'cart_item_id' => Str::uuid()->toString(), // Ensure unique ID for each cart item
            'order_name' => $this->order_name,
            'order_code' => $this->order_code,
            'quantity' => $this->quantity,
            'category' => $menu->category,
            'price' => $menu->price * $this->quantity,
            'order_date' => $this->order_date,
        ];

        // Save cart, order_code, and order_date to session
        $userId = Auth::id();
        session([
            "cart_{$userId}" => $this->cart,
            "order_code_{$userId}" => $this->order_code,
            "order_date_{$userId}" => $this->order_date // Save to session
        ]);

        toastr()->info("{$this->order_name} is added to cart.");
        $this->updateTotalAmount();
        $this->reset(['order_name']); // Only reset order_name, not quantity
        $this->quantity = 1; // Explicitly set quantity back to 1
        $this->dispatch('item-added');
        $this->dispatch('refresh-tom-select'); // Dispatch event to reinitialize Tom Select
    }

   public function removeFromCart($cartItemId)
    {
        // Use null coalescing to safely access cart_item_id during filtering
        $filteredCart = array_filter($this->cart, fn($item) => ($item['cart_item_id'] ?? null) !== $cartItemId);
        
        // IMPORTANT: Re-index the array after filtering
        $this->cart = array_values($filteredCart); 

        $userId = Auth::id();
        session(["cart_{$userId}" => $this->cart]);
        $this->updateTotalAmount();
        toastr()->info('Item is removed from cart.');
        $this->dispatch('refresh-tom-select');
        $this->dispatch('cart-updated');
    }

    public function updateCartItem($cartItemId, $quantity)
    {
        $quantity = (int)$quantity;
        if ($quantity < 1) { // Prevent quantity from going below 1
            $quantity = 1;
        }

        foreach ($this->cart as &$item) {
            // Use null coalescing to safely access cart_item_id during iteration
            if (($item['cart_item_id'] ?? null) === $cartItemId) {
                $menu = FnbMenu::where('name', $item['order_name'])->first();
                if ($menu) { // Ensure menu is found before calculating price
                    $item['quantity'] = $quantity;
                    $item['price'] = $menu->price * $item['quantity'];
                } else {
                    toastr()->error('Menu item for cart update not found.'); // Handle missing menu
                }
                break;
            }
        }

        $userId = Auth::id();
        session(["cart_{$userId}" => $this->cart]);
        $this->updateTotalAmount();
        toastr()->info('Cart item updated.');
        $this->dispatch('refresh-tom-select');
        $this->dispatch('cart-updated');
    }

    public function clearCart()
    {
        $userId = Auth::id();
        $this->cart = [];
        $this->order_code = '';
        // Reset order_date to today's date, not empty
        $this->order_date = Carbon::now()->format('Y-m-d');
        session()->forget(["cart_{$userId}", "order_code_{$userId}", "order_date_{$userId}"]);
        $this->updateTotalAmount();
        toastr()->info('Cart cleared.');
        $this->dispatch('refresh-tom-select');
        $this->dispatch('cart-updated');
    }
    
    public function submitOrder()
    {
        if (empty($this->cart)) {
            toastr()->error('Cart is empty.');
            return;
        }

        // Regenerate order_code if empty
        if (empty($this->order_code)) {
            $this->order_code = $this->generateOrderCode();
            $userId = Auth::id();
            session(["order_code_{$userId}" => $this->order_code]);
        }

        foreach ($this->cart as $item) {
            FnbOrder::create([
                'order_code' => $this->order_code,
                'order_name' => $item['order_name'],
                'order_date' => $item['order_date'],
                'category' => $item['category'],
                'user_id' => Auth::id(),
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        $this->clearCart();
        toastr()->info('Order is submitted successfully.');
    }

    public function submitAndPrint()
    {
        if (empty($this->cart)) {
            toastr()->error('Cart is empty.');
            return;
        }

        // Regenerate order_code if empty
        if (empty($this->order_code)) {
            $this->order_code = $this->generateOrderCode();
            $userId = Auth::id();
            session(["order_code_{$userId}" => $this->order_code]);
        }

        // Save data for printing BEFORE clearing cart
        $this->printCart = $this->cart;
        $this->printOrderCode = $this->order_code;
        $this->printTotalAmount = $this->totalAmount;

        // Save order
        foreach ($this->cart as $item) {
            FnbOrder::create([
                'order_code' => $this->order_code,
                'order_name' => $item['order_name'],
                'order_date' => $item['order_date'],
                'category' => $item['category'],
                'user_id' => Auth::id(),
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        // Prepare for printing
        $this->printOrder = true;
        $this->dispatch('submit-and-print');
        toastr()->info('Order submitted and printing.');
        $this->clearCart(); // Clear cart AFTER saving print data
    }

    public function resetPrintOrder()
    {
        $this->printOrder = false;
        $this->printCart = [];
        $this->printOrderCode = ''; // Reset print order code
        $this->printTotalAmount = 0; // Reset print total amount
    }

    public function destroy($id)
    {
        $order = FnbOrder::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        $code = $order->order_code;

        FnbOrder::where('order_code', $code)
            ->where('user_id', Auth::id())
            ->delete();

        toastr()->info("All orders with code {$code} deleted successfully.");
    }
    
    // Placeholder for delete permission check
    public function checkDeletePermission($id)
    {
        toastr()->error('Delete functionality has been disabled.');
        return;
    }

    // New method to show receipt
    public function showReceipt($id)
    {
        $order = FnbOrder::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        $orderCode = $order->order_code;
        
        // Get all items for this order code
        $this->receiptItems = FnbOrder::where('order_code', $orderCode)
            ->where('user_id', Auth::id())
            ->get()
            ->toArray();
        
        $this->receiptOrderCode = $orderCode;
        $this->receiptTotalAmount = collect($this->receiptItems)->sum('price');
        $this->showReceiptModal = true;
        
        $this->dispatch('show-receipt-modal');
    }

    public function closeReceiptModal()
    {
        $this->showReceiptModal = false;
        $this->receiptItems = [];
        $this->receiptOrderCode = '';
        $this->receiptTotalAmount = 0;
    }

    public function printReceipt()
    {
        $this->dispatch('print-receipt-thermal');
    }

    public function updateTotalAmount()
    {
        $this->totalAmount = array_sum(array_column($this->cart, 'price'));
    }

    public function exit()
    {
        $this->reset(['order_name']); // Only reset order_name
        $this->quantity = 1; // Explicitly set quantity back to 1
        $this->modal_title = 'Make an Order';
        $this->dispatch('refresh-tom-select');
    }
    
    // Updated method to refresh the cart section of the modal
    public function refreshCart()
    {
        $this->dispatch('refresh-tom-select');
        $this->dispatch('cart-updated');
    }

    public function refreshSalesData()
    {
        $query = FnbOrder::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc');
    
        // Apply date filters if provided
        if (!empty($this->salesFromDate)) {
            $query->whereDate('order_date', '>=', $this->salesFromDate);
        }
    
        if (!empty($this->salesToDate)) {
            $query->whereDate('order_date', '<=', $this->salesToDate);
        }
    
        $this->salesData = $query->get();
    }
    
    public function updatedSalesFromDate()
    {
        $this->refreshSalesData();
    }
    
    public function updatedSalesToDate()
    {
        $this->refreshSalesData();
    }


    public function render()
    {
        $orders = FnbOrder::where('user_id', Auth::id())
            ->where('created_at', '>=', Carbon::now()->subDays(14))
            ->orderBy('id', 'desc')
            ->get();

        return view('livewire.fnb.order', [
            'orders' => $orders,
            'printCart' => $this->printCart,
        ])->layout('layouts.fnb');
    }
}