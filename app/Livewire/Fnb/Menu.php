<?php

namespace App\Livewire\Fnb;

use App\Models\FnbMenu;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

use App\Http\Helpers\Helper;
#[Title('Menu Management')]
class Menu extends Component
{
    use WithPagination;

    public $menus;
    public $menu_id, $name, $description, $category, $price;
    public $available = 1;
    public $modal_flag = false;
    public $modal_title = 'Add Menu Item';

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'category' => 'required',
        'price' => 'required|numeric|min:0',
    ];

    public function render()
    {

        $this->menus = FnbMenu::all();
        return view('livewire.fnb.menu')->layout('layouts.fnb');
    }


    // Reset form fields
    public function exit()
    {
        $this->reset(); //keyword
    }

    // Save a new or updated asset
    public function save()
    {

        $this->validate();

        FnbMenu::updateOrCreate(
            ['id' => $this->menu_id],
            [
                'name' => $this->name,
                'description' => $this->description,
                'category' => $this->category,
                'price' => $this->price,
                'available' => $this->available,
            ]
        );

        toastr()->info( $this->menu_id ? 'Menu updated successfully!' : 'New menu item added successfully!');
        $this->reset();
    }

    public function edit($id)
    {
        $menu = FnbMenu::findOrFail($id);
        $this->menu_id = $menu->id;
        $this->name = $menu->name;
        $this->description = $menu->description;
        $this->category = $menu->category;
        $this->price = $menu->price;
        $this->available = $menu->available;
        $this->modal_title = 'Edit Menu Item';
        $this->modal_flag = true;
    }

    public function delete($id)
    {
        FnbMenu::findOrFail($id)->delete();
        toastr()->info('Menu item deleted successfully!');
    }
}

