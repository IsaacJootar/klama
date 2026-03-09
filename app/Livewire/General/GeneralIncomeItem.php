<?php
namespace App\Livewire\General;

use App\Models\GeneralIncItem;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;


#[Title('General Manager | General income Item ')]
class GeneralIncomeItem extends Component
{

    public  $items; // fleet  instance

    #[Validate('required|min:1')]
    public $item = '';

    public $modal_title = 'Add New income item.';

    public  $modal_flag = false; // event flag for edit
    public $item_id; //create | update (modal flag)




    public function save()
    {
        
        try {
       $this->validate();// validate and then save
    } catch (ValidationException $e) {
         $this->reset();
    }
        GeneralIncItem::updateOrCreate(
        ['id' =>$this->item_id],
            [
                'item'=>$this->item,
            ]

        );

        toastr()->info($this->item_id ? 'Income Item Has Been Updated  Successfuly' : 'Income Item Has Been Added Successfuly' );
        //$this->dispatch('item-saved');
        $this->reset();
    }
    public function edit($id)
    {
        $this->item = GeneralIncItem::findOrFail($id);
        $this->item_id = $this->item->id;
        $this->item = $this->item->item;
        $this->modal_flag = true;
        $this->modal_title = 'Update income Item';
    }

    public function exit()
    { //rest modal feilds
        $this->reset();
    }

    public function destroy($id)
    {
        $item = GeneralIncItem::findOrFail($id);
        $item->delete();
        toastr()->info('Income item is deleted successfully');
    }



    public function render()
    {
        $this->items = GeneralIncItem::all();
        return view('livewire.general.general-income-item')->layout('layouts.general');
    }



}

 