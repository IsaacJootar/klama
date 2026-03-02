<?php
namespace App\Livewire\Fnb;

use App\Models\KitchenStoreCategories;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Kitchen | Manage Store Categories')]
class KitchenStoreCategory extends Component
{
    public $categories;
    
    #[Validate('required|min:3')]
    public $category = '';
    
    public $modal_title = 'Add New Store Category.';
    public $modal_flag = false;
    public $category_id;

    public function save()
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->reset();
        }
        
        KitchenStoreCategories::updateOrCreate(
            ['id' => $this->category_id],
            ['category' => $this->category]
        );
        
        toastr()->info($this->category_id ? 'Store category has been updated successfully' : 'Store category has been added successfully');
        $this->reset();
    }

    public function edit($id)
    {
        $category = KitchenStoreCategories::findOrFail($id);
        $this->category_id = $category->id;
        $this->category = $category->category;
        $this->modal_flag = true;
        $this->modal_title = 'Update Store Category';
    }

    public function exit()
    {
        $this->reset();
    }

    public function destroy($id)
    {
        $category = KitchenStoreCategories::findOrFail($id);
        $category->delete();
        toastr()->info('Store category has been deleted successfully');
    }

    public function render()
    {
        $this->categories = KitchenStoreCategories::all();
        return view('livewire.fnb.kitchen-store-category')->layout('layouts.fnb');
    }
}