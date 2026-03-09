<?php

namespace App\Livewire\Fnb;

use App\Models\KitchenStoreItems;
use App\Models\KitchenStoreCategories;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Kitchen | Manage Store Items')]
class KitchenStoreItem extends Component
{
    public $items;
    public $categories;

    #[Validate('required|min:2')]
    public $item = '';

    #[Validate('nullable|min:2')]
    public $measurement_tag = '';

    #[Validate('nullable|exists:fnb_kitchen_store_categories,id')]
    public $category_id = '';

    public $modal_title = 'Add New Store Item.';
    public $modal_flag = false;
    public $item_id;

   

    public function save()
    {
        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->reset();
        }

        KitchenStoreItems::updateOrCreate(
            ['id' => $this->item_id],
            [
                'item' => $this->item,
                'measurement_tag' => $this->measurement_tag,
                'category_id' => $this->category_id,
            ]
        );

        toastr()->info($this->item_id ? 'Store item has been updated successfully' : 'Store item has been added successfully');
        $this->reset();
    }

    public function edit($id)
    {
        $item = KitchenStoreItems::findOrFail($id);
        $this->item_id = $item->id;
        $this->item = $item->item;
        $this->measurement_tag = $item->measurement_tag;
        $this->category_id = $item->category_id;
        $this->modal_flag = true;
        $this->modal_title = 'Update Store Item';
    }

    public function exit()
    {
        $this->reset();
    }

    public function destroy($id)
    {
        $item = KitchenStoreItems::findOrFail($id);
        $item->delete();
        toastr()->info('Store item has been deleted successfully');
    }

    public function render()
    {
        $this->categories = KitchenStoreCategories::all();
        $this->items = KitchenStoreItems::with('category')->get();
        return view('livewire.fnb.kitchen-store-item')->layout('layouts.fnb');
    }
}