<?php

namespace App\Livewire\Fnb;

use Livewire\Component;
use App\Models\FnbInventoryCat;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Flasher\Toastr\Prime\ToastrInterface;

#[title('Food and Beverage  | Inventory Category')]

class FinventoryCat extends Component
{
    public $categories; // List of categories
    public $name, $category_id; // For editing specific categories
    public  $modal_flag = false; //  flag for edit
    public $modal_title = 'Create New Inventory Category.';

    // Validation rules
    protected $rules = [
        'name' => 'required|string|max:255', // Ensure the name is unique
    ];
    public function render()
    {
        // Fetch all categories
        $this->categories = FnbInventoryCat::all();
        return view('livewire.fnb.finventory-cat')->layout('layouts.fnb');
    }

     // Reset form fields
     public function exit()
     {
         $this->reset(); //keyword
     }

     // Save a new or updated Inventory
     public function save()
     {
         //dd($this->name);
         //dd($this->category_id);

         $this->validate();

         FnbInventoryCat::updateOrCreate(
             ['id' => $this->category_id],
             [
                 'name' => $this->name,
             ]
         );

         toastr()->info( $this->category_id ? 'Inventory category updated successfully!' : 'Inventory category created successfully!');
         $this->reset(); //reset the fields
     }

     // Edit an existing Inventory
     public function edit($id)
     {
         $category  = FnbInventoryCat::findOrFail($id);
         $this->category_id = $category ->id;
         $this->name = $category ->name;
         $this->modal_flag = true;
         $this->modal_title = 'Update Inventory';
     }

     // Delete an Inventory
     public function delete($id)
     {
         FnbInventoryCat::findOrFail($id)->delete();
         toastr()->info( 'Inventory category deleted successfully!');
     }
 }
