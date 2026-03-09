<?php

namespace App\Livewire\General;
use App\Models\HotelSection;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
#[Title('Hotel Sections')]
class HotelSections extends Component
{

    public $sections;
    #[Validate('required|unique:hotel_sections,section')]
    public $section;
    public $modal_title = 'Activated New Hotel Work Section.';


    public function save()
    {
       $this->validate();// validate and then save
        HotelSection::create([
            'section'=>$this->section,
        ]);

        toastr()->info('Hotel Section  Has Been Activated Successfuly' );
        $this->reset();
    }


    public function exit()
    { //rest modal feilds
        $this->reset();
    }

    public function render()
    {
        $this->sections = HotelSection::all();
        return view('livewire.general.hotel-sections')->layout('layouts.general');
    }
}
