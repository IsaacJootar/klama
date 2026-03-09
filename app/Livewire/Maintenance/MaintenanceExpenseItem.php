<?php
namespace App\Livewire\Maintenance;

use App\Models\MaintenanceExpItem;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;


#[Title('Maintenance | Expense Items ')]
class MaintenanceExpenseItem extends Component
{

    public  $items; // items instance

    #[Validate('required|min:1')]
    public $item = '';

    public $modal_title = 'Add New Expense item.';

    public  $modal_flag = false; // event flag for edit
    public $item_id; //create | update (modal flag)




    public function save()
    {
        
        try {
       $this->validate();// validate and then save
    } catch (ValidationException $e) {
         $this->reset();
    }
        MaintenanceExpitem::updateOrCreate(
        ['id' =>$this->item_id],
            [
                'item'=>$this->item,
            ]

        );

        toastr()->info($this->item_id ? 'Expense Item Has Been Updated  Successfuly' : 'Expense Item Has Been Added Successfuly' );
        //$this->dispatch('item-saved');
        $this->reset();
    }
    public function edit($id)
    {
        $this->item = MaintenanceExpItem::findOrFail($id);
        $this->item_id = $this->item->id;
        $this->item = $this->item->item;
        $this->modal_flag = true;
        $this->modal_title = 'Update Expense Item';
    }

    public function exit()
    { //rest modal feilds
        $this->reset();
    }

    public function destroy($id)
    {
        $item = MaintenanceExpItem::findOrFail($id);
        $item->delete();
        toastr()->info('Expense item is deleted successfully');
    }



    public function render()
    {
        $this->items = MaintenanceExpItem::all();
        return view('livewire.maintenance.maintenance-expense-item')->layout('layouts.maintenance');
    }



}

