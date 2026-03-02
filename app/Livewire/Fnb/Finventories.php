<?php

namespace App\Livewire\Fnb;

use Livewire\Component;
use App\Models\FnbInventoryCat;
use App\Models\FnbInventory;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Flasher\Toastr\Prime\ToastrInterface;


#[title('Food and Beverage | Inventory')]

class Finventories extends Component
{
    public $inventories; // Stores inventory data
    public $cats; // Categories
    public $item_name, $category_id, $quantity, $price, $condition; // Inventory item fields
    public $item_id; // Used for editing items
    public  $modal_flag = false; //  flag for edit
    public $modal_title = 'Add Inventory Asset.';

    // Validation rules
    protected $rules = [
        'item_name' => 'required|string|max:255',
        'category_id' => 'required',
        'quantity' => 'required|integer|min:0',
        'price' => 'required|integer|min:0',
        'condition' => 'required',
    ];

    public function render()
    {

        $this->inventories = FnbInventory::all(); // Fetch all inventory items
        $this->cats = FnbInventoryCat::all();
        return view('livewire.fnb.finventories')->layout('layouts.fnb');
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

        FnbInventory::updateOrCreate(

         ['id' => $this->item_id],
         [
             'item_name' => $this->item_name,
             'category_id' => $this->category_id,
             'quantity' => $this->quantity,
             'price' => $this->price,
             'condition' => $this->condition,
         ]
     );

     toastr()->info(  $this->item_id ? 'Inventory updated successfully!' : 'Inventory created successfully!');
     $this->reset(); //reset the fields
 }

 // Edit an existing item
 public function edit($id)
 {
     $item = FnbInventory::findOrFail($id);
     $this->item_id = $item->id;
     $this->item_name = $item->item_name;
     $this->quantity = $item->quantity;
     $this->price = $item->price;
     $this->condition = $item->condition;
     $this->category_id = $item->category_id;
     $this->modal_flag = true;
     $this->modal_title = 'Update Inventory';
 }

 // Delete an item
 public function delete($id)
 {
    FnbInventory::findOrFail($id)->delete();
     toastr()->info( 'Item deleted successfully!');
 }
}

