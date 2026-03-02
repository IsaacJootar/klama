<?php

namespace App\Livewire\Fnb;

use App\Models\KitchenStoreInventories;
use App\Models\KitchenStoreItems;
use App\Models\KitchenStoreLogs;
use Livewire\Component;
use Livewire\Attributes\Title;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

#[Title('Kitchen | Manage Store')]
class KitchenManageStore extends Component
{
    public $inventory;
    public $logs;
    public $items;
    public $selectedItem;
    public $quantity;
    public $selectedItemDeduct;
    public $quantityDeduct;
    public $reportFromDate;
    public $reportToDate;
    public $reportData;
    public $totalAdditions = 0;
    public $totalDeductions = 0;
    public $netChange = 0;
    public $logFromDate;
    public $logToDate;
    public $logTotalAdditions = 0;
    public $logTotalDeductions = 0;
    public $logNetChange = 0;

    public function mount()
    {
        $this->items = KitchenStoreItems::all();
        $this->inventory = KitchenStoreInventories::with('item')->get();
        $this->logFromDate = Carbon::today()->format('Y-m-d');
        $this->logToDate = Carbon::today()->format('Y-m-d');
        $this->filterLogs();
        $this->reportFromDate = Carbon::now()->startOfWeek()->format('Y-m-d');
        $this->reportToDate = Carbon::now()->format('Y-m-d');
        $this->reportData = collect([]);
    }

    public function addToStore()
    {
        if (!$this->selectedItem || !$this->quantity) {
            toastr()->error('Please select an item and enter a quantity');
            return;
        }
        $this->addItem($this->selectedItem, $this->quantity);
        $this->reset(['selectedItem', 'quantity']);
    }

    public function deductFromStore()
    {
        if (!$this->selectedItemDeduct || !$this->quantityDeduct) {
            toastr()->error('Please select an item and enter a quantity');
            return;
        }
        $this->deductItem($this->selectedItemDeduct, $this->quantityDeduct);
        $this->reset(['selectedItemDeduct', 'quantityDeduct']);
    }

    public function addItem($itemId, $quantity)
    {
        $inventory = KitchenStoreInventories::where('item_id', $itemId)->first();
        if (!$inventory) {
            $inventory = KitchenStoreInventories::create([
                'item_id' => $itemId,
                'quantity' => 0,
                'last_updated' => now(),
            ]);
        }

        $quantityBefore = $inventory->quantity;
        $inventory->quantity += $quantity;
        $inventory->last_updated = now();
        $inventory->save();

        KitchenStoreLogs::create([
            'item_id' => $itemId,
            'action' => 'add',
            'quantity_changed' => $quantity,
            'quantity_before' => $quantityBefore,
            'quantity_after' => $inventory->quantity,
            'timestamp' => now(),
            'user_id' => Auth::id(),
        ]);

        toastr()->info('Item added to store successfully');
        $this->inventory = KitchenStoreInventories::with('item')->get();
        $this->filterLogs();
    }

    public function deductItem($itemId, $quantity)
    {
        $inventory = KitchenStoreInventories::where('item_id', $itemId)->first();
        if (!$inventory || $inventory->quantity < $quantity) {
            toastr()->error('Insufficient quantity in store');
            return;
        }

        $quantityBefore = $inventory->quantity;
        $inventory->quantity -= $quantity;
        $inventory->last_updated = now();
        $inventory->save();

        KitchenStoreLogs::create([
            'item_id' => $itemId,
            'action' => 'deduct',
            'quantity_changed' => $quantity,
            'quantity_before' => $quantityBefore,
            'quantity_after' => $inventory->quantity,
            'timestamp' => now(),
            'user_id' => Auth::id(),
        ]);

        toastr()->info('Item deducted from store successfully');
        $this->inventory = KitchenStoreInventories::with('item')->get();
        $this->filterLogs();
    }

    public function filterLogs()
    {
        $this->logs = KitchenStoreLogs::with(['item', 'user'])
            ->whereBetween('timestamp', [$this->logFromDate, $this->logToDate . ' 23:59:59'])
            ->orderBy('timestamp', 'desc')
            ->get();

        $this->logTotalAdditions = $this->logs->where('action', 'add')->sum('quantity_changed');
        $this->logTotalDeductions = $this->logs->where('action', 'deduct')->sum('quantity_changed');
        $this->logNetChange = $this->logTotalAdditions - $this->logTotalDeductions;
    }

    public function generateReport()
    {
        $this->reportData = KitchenStoreLogs::with(['item', 'user'])
            ->whereBetween('timestamp', [$this->reportFromDate, $this->reportToDate])
            ->orderBy('timestamp', 'desc')
            ->get();

        $this->totalAdditions = $this->reportData->where('action', 'add')->sum('quantity_changed');
        $this->totalDeductions = $this->reportData->where('action', 'deduct')->sum('quantity_changed');
        $this->netChange = $this->totalAdditions - $this->totalDeductions;
    }

    public function render()
    {
        return view('livewire.fnb.kitchen-manage-store')->layout('layouts.fnb');
    }
}