<?php

namespace App\Livewire\Fnb;

use Livewire\Component;
use App\Models\FnbSupplier;
use Livewire\Attributes\Title;

#[Title('Food and Beverage  | Dashboard')]

class Supplier extends Component
{
    public $suppliers;
    public $name, $address, $phone, $email, $supplier_id;
    public $modal_flag = false; // flag for edit
    public $modal_title = 'Create New Supplier.';

    protected $rules = [
        'name' => 'required|string|max:255',
        'address' => 'required|string',
        'phone' => 'required|numeric|',
        'email' => 'required|string|',
    ];

    public function render()
    {
        $this->suppliers = FnbSupplier::all();
        return view('livewire.fnb.supplier')->layout('layouts.fnb');
    }

     // Reset form fields
     public function exit()
     {
         $this->reset();
     }

     // Save a new or updated order
     public function save()
     {
         $this->validate();

         FnbSupplier::updateOrCreate(
            ['id' => $this->supplier_id],
             [
                 'name' => $this->name,
                 'address' => $this->address,
                 'phone' => $this->phone,
                 'email' => $this->email,
                 'is_active' => true,
             ]
         );

         toastr()->info( $this->supplier_id ? 'Supplier updated successfully!' : 'Supplier created successfully!');
         $this->reset();
     }

          // Edit an existing order
     public function edit($id)
     {
         $supplier = FnbSupplier::findOrFail($id);
         $this->supplier_id = $supplier->id;
         $this->name = $supplier->name;
         $this->address = $supplier->address;
         $this->phone = $supplier->phone;
         $this->email = $supplier->email;
         $this->modal_flag = true;
         $this->modal_title = 'Update Supplier';
     }


     // Delete an order
     public function delete($id)
     {
        FnbSupplier::findOrFail($id)->delete();
         toastr()->info( 'Supplier deleted successfully!');
     }
 }
