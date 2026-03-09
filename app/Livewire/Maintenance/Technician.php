<?php

namespace App\Livewire\Maintenance;

use Livewire\Component;
use App\Models\MaintTechnician;
use Livewire\Attributes\Title;

#[Title('Maintenance  | Technician')]


class Technician extends Component
{
    public $technicians;
    public $name, $address, $phone, $email, $technician_id;
    public $modal_flag = false; // flag for edit
    public $modal_title = 'Add New Technician.';

    protected $rules = [
        'name' => 'required|string|max:255',
        'address' => 'required|string',
        'phone' => 'required|numeric|',
        'email' => 'required|string|',
    ];
    public function render()
    {

        $this->technicians = MaintTechnician::all();
        return view('livewire.maintenance.technician')->layout('layouts.maintenance');
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

      MaintTechnician::updateOrCreate(
         ['id' => $this->technician_id],
          [
              'name' => $this->name,
              'address' => $this->address,
              'phone' => $this->phone,
              'email' => $this->email,
              'is_active' => true,
          ]
      );

      toastr()->info( $this->technician_id ? 'Technician updated successfully!' : 'Technician created successfully!');
      $this->reset();
  }

       // Edit an existing order
  public function edit($id)
  {
      $technician = Fnbtechnician::findOrFail($id);
      $this->technician_id = $technician->id;
      $this->name = $technician->name;
      $this->address = $technician->address;
      $this->phone = $technician->phone;
      $this->email = $technician->email;
      $this->modal_flag = true;
      $this->modal_title = 'Update Technician';
  }


  // Delete an order
  public function delete($id)
  {
     MaintTechnician::findOrFail($id)->delete();
      toastr()->info( 'Technician deleted successfully!');
  }
}
