<?php

namespace App\Livewire\Maintenance;

use App\Models\MaintAsset;
use App\Models\MaintAssetCat;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Flasher\Toastr\Prime\ToastrInterface;

#[title('Maintenance | Assets Category')]

class AssetManager extends Component

{
    public $assets; // List of all assets
    public $cats; // Categories
    public $asset_id, $name, $location, $purchase_date, $last_maintenance_date, $status, $category_id;  // Asset properties
    public  $modal_flag = false; //  flag for edit
    public $modal_title = 'Add New Asset.';
    // Validation rules
    protected $rules = [
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'purchase_date' => 'nullable|date',
        'last_maintenance_date' => 'nullable|date',
        'status' => 'required|in:Operational,Under Maintenance,Decommissioned',
    ];



    public function render()
    {
        // Fetch all assets to display
        $this->assets = MaintAsset::all();
        $this->cats = MaintAssetCat::all();
        return view('livewire.maintenance.asset-manager')->layout('layouts.maintenance');
    }

    // Reset form fields
    public function exit()
    {
        $this->reset(); //keyword
    }

    // Save a new or updated asset
    public function save()
    {
        //dd($this->name);
        //dd($this->category_id);

        $this->validate();

        MaintAsset::updateOrCreate(


            ['id' => $this->asset_id],
            [
                'name' => $this->name,
                'location' => $this->location,
                'purchase_date' => $this->purchase_date,
                'last_maintenance_date' => $this->last_maintenance_date,
                'status' => $this->status,
                'category_id' => $this->category_id,
            ]
        );

        toastr()->info( $this->asset_id ? 'Asset updated successfully!' : 'Asset created successfully!');
        $this->reset(); //reset the fields
    }

    // Edit an existing asset
    public function edit($id)
    {
        $asset = MaintAsset::findOrFail($id);
        $this->asset_id = $asset->id;
        $this->name = $asset->name;
        $this->location = $asset->location;
        $this->purchase_date = $asset->purchase_date;
        $this->last_maintenance_date = $asset->maintenance_date;
        $this->status = $asset->status;
        $this->category_id = $asset->category_id;
        $this->modal_flag = true;
        $this->modal_title = 'Update Asset';
    }

    // Delete an asset
    public function delete($id)
    {
        MaintAsset::findOrFail($id)->delete();
        toastr()->info( 'Asset deleted successfully!');
    }




}
