<?php

namespace App\Livewire\Logistics;
use App\Models\Fleet;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;


#[Title('Logistics | Fleet Items ')]
class FleetItems extends Component
{

    public  $fleets; // fleet  instance
    public  $fleet;


    #[Validate('required')]
    public $item_number = '';

    #[Validate('required|min:5')]
    public $item_name = '';

    #[Validate('required')]
    public $category = '';

    public $modal_title = 'Add New Fleet Item.';

    public  $modal_flag = false; // event flag for edit
    public $fleet_id; //create | update (modal flag)




    public function save()
    {
        
        try {
       $this->validate();// validate and then save
    } catch (ValidationException $e) {
         $this->reset();
    }
        Fleet::updateOrCreate(
        ['id' =>$this->fleet_id],
            [
                'item_name'=>$this->item_name,
                'item_number'=>$this->item_number,
                'category'=>$this->category,
            ]

        );

        toastr()->info($this->fleet_id ? 'Fleet Item Has Been Added Successfuly' : 'Fleet Item Has Been Updated Successfuly' );
        //$this->dispatch('fleet-saved');
        $this->reset();
    }
    public function edit($id)
    {
        $this->fleet = Fleet::findOrFail($id);
        $this->fleet_id = $this->fleet->id;
        $this->item_name = $this->fleet->item_name;
        $this->item_number = $this->fleet->item_number;
        $this->category = $this->fleet->category;
        $this->modal_flag = true;
        $this->modal_title = 'Update Fleet Item';
    }

    public function exit()
    { //rest modal feilds
        $this->reset();
    }

    public function destroy($id)
    {
        $fleet = Fleet::findOrFail($id);
        $fleet->delete();
        toastr()->info('Fleet Item is deleted successfully');
    }



    public function render()
    {
        $this->fleets = Fleet::all();
        return view('livewire.logistics.fleet-items')->layout('layouts.logistics');
    }



}
