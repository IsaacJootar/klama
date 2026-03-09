<?php


namespace App\Livewire\Reservations;

use App\Models\Room;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Flasher\Toastr\Prime\ToastrInterface;

#[title('Create Rooms')]

class CreateRooms extends Component
{
    public $room;

    #[Validate('required|min:5|unique:resv_rooms,name')]
    public $name = '';

    public $modal_title = 'Create New Room.';
    public  $modal_flag = false;


    public function store()
    {
        $validation = $this->validate();
        Room::create($validation);
        $this->dispatch('refresh-rooms');
        toastr()->info('Room Has Been Added Successfuly');

        $this->reset();
    }


    #[On('modal-flag')] // from modal dispatch
    public function edit($id)
    {
        $this->room = Room::findOrFail($id);
        $this->name = $this->room->name;
        $this->modal_flag = true; // for triggering modal form Update
        $this->modal_title = 'Update Room';
    }

    public function update()
    {
        $validation = $this->validate();
        $update = Room::find($this->room->id);
        $update->update($validation);
        // $this->only(['title', 'content'])-this too will work
        $this->dispatch('refresh-rooms');
         toastr()->info('Room is Updated successfully');
    }
    public function exit()
    { //rest modal feilds
        $this->reset();
    }

    public function render()
    {
        return view('livewire.reservations.create-rooms')
            ->layout('layouts.reservations');
    }
}
