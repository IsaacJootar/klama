<?php

namespace App\Livewire\Maintenance;

use Livewire\Component;
use App\Models\MaintInventoryCat;
use App\Models\MaintInventories;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Flasher\Toastr\Prime\ToastrInterface;


#[title('Maintenance | Inventory')]

class Inventories extends Component
{
    public $inventories; // Stores inventory data
    public $cats; // Categories
    public $item_name, $category_id, $quantity, $price, $restock_threshold, $status; // Inventory item fields
    public $item_id; // Used for editing items
    public  $modal_flag = false; //  flag for edit
    public $modal_title = 'Add Inventory Asset.';

    // Validation rules
    protected $rules = [
        'item_name' => 'required|string|max:255',
        'category_id' => 'required|exists:maint_inventory_cat,id',
        'quantity' => 'required|integer|min:0',
        'price' => 'required|integer|min:0',
        'restock_threshold' => 'required|integer|min:1',
        'status' => 'required|in:Operational,Under Maintenance,Decommissioned',
    ];

    public function render()
    {

        $this->inventories = MaintInventories::all(); // Fetch all inventory items
        $this->cats = MaintInventorycat::all();
        return view('livewire.maintenance.inventories')->layout('layouts.maintenance');
    }
    // Reset form fields
    public function exit()
    {
        $this->reset(); //keyword
    }

    // Save a new or updated asset
    public function save()
    {
        //dd($this->name);
        //dd($this->category_id);

        $this->validate();

        MaintInventories::updateOrCreate(

         ['id' => $this->item_id],
         [
             'item_name' => $this->item_name,
             'category_id' => $this->category_id,
             'quantity' => $this->quantity,
             'price' => $this->price,
             'restock_threshold' => $this->restock_threshold,
             'status' => $this->status,
         ]
     );

     toastr()->info(  $this->item_id ? 'Inventory updated successfully!' : 'Inventory created successfully!');
     $this->reset(); //reset the fields
 }

 // Edit an existing item
 public function edit($id)
 {
     $item = MaintInventories::findOrFail($id);
     $this->item_id = $item->id;
     $this->item_name = $item->item_name;
     $this->quantity = $item->quantity;
     $this->price = $item->price;
     $this->restock_threshold = $item->restock_threshold;
     $this->status = $item->status;
     $this->modal_flag = true;
     $this->modal_title = 'Update Inventory';
 }

 // Delete an item
 public function delete($id)
 {
    MaintInventories::findOrFail($id)->delete();
     toastr()->info( 'Item deleted successfully!');
 }
}

