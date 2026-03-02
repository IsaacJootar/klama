<?php

namespace App\Livewire\Maintenance;

use App\Models\MaintAssetCat;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Flasher\Toastr\Prime\ToastrInterface;

#[title('Maintenance | Assets Category')]

class AssetCat extends Component
{
    public $categories;
    public $name,  $category_id;
    public  $modal_flag = false; //  flag for edit
    public $modal_title = 'Create New Asset Category.';

    protected $rules = [
        'name' => 'required|string|max:255|unique:maint_asset_cat,name',
    ];
    public function render()
    {
        $this->categories = MaintAssetCat::all();
        return view('livewire.maintenance.asset-cat')->layout('layouts.maintenance');
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

        MaintAssetCat::updateOrCreate(
            ['id' => $this->category_id],
            [
                'name' => $this->name,
            ]
        );

        toastr()->info( $this->category_id ? 'Asset category updated successfully!' : 'Asset category created successfully!');
        $this->reset(); //reset the fields
    }

    // Edit an existing asset
    public function edit($id)
    {
        $category  = MaintAssetCat::findOrFail($id);
        $this->category_id = $category ->id;
        $this->name = $category ->name;
        $this->modal_flag = true;
        $this->modal_title = 'Update Asset';
    }

    // Delete an asset
    public function delete($id)
    {
        MaintAssetCat::findOrFail($id)->delete();
        toastr()->info( 'Asset category deleted successfully!');
    }
}
