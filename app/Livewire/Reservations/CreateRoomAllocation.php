<?php


namespace App\Livewire\Reservations;

use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Title;
use App\Models\Roomallocation;
use App\Models\Room;
use App\Models\Roomcategory;
use Livewire\Component;
use Livewire\Attributes\On;

#[title('Rooms Allocations')]

class CreateRoomAllocation  extends Component
{
    public $allocations;


    public $category_id = '';
    public $room_id = '';
    public $price = '';

    public $modal_title = 'Allocate Rooms.';
    public  $modal_flag = false;




    public function store()
    {
        $validation = $this->validate(
            [
                'category_id' => ['required'],
                'room_id' => ['required'],
                'price' => ['required', 'numeric'],
            ],
            [
                'category_id.required' => 'Please select a room category.',
                'room_id.required' => 'Please select a room ',
                'price.required' => 'Price value is required ',
                'price.numeric' => 'Price must be numeric in value '
            ]
        );



        // dont alllocate same room and category twice
        if (Roomallocation::where('room_id', $this->room_id)
            ->where('category_id', $this->category_id)
            ->exists()
        )

        {

            throw ValidationException::withMessages(['message' => ['This room & category  is already allocated']]);
        }




        Roomallocation::create($validation);
        $this->dispatch('refresh-allocations');
        toastr()->info('Room  Allocations is Successful');
        $this->reset();
    }


    #[On('modal-flag')] // from modal dispatch, flag for displaying update form
    public function edit($id)
    {
        $this->allocations = Roomallocation::findOrFail($id);
        $this->category_id = $this->allocations->category_id;
        $this->room_id = $this->allocations->room_id;
        $this->price = $this->allocations->price;
        $this->modal_flag = true; // for triggering modal form Update
        $this->modal_title = 'Update Room Allocaions';
    }

    public function update()
    {
        $validation = $this->validate([
            'category_id' => ['required'],
            'room_id' => ['required'],
            'price' => ['required', 'numeric'],

        ]);
        $update = Roomallocation::findOrFail($this->allocations->id);
        $update->update($validation);
        $this->dispatch('refresh-allocations');
        toastr()->info('Room Categories is Updated successfully');
    }
    public function exit()
    { //rest modal feilds
        $this->reset();
    }

    public function render()
    {

        $rooms = Room::orderBy("id", "desc")->get();
        $categories = Roomcategory::orderBy("id", "desc")->get();
        return view('livewire.reservations.create-room-allocation', [
            'rooms' => $rooms,
            'categories' => $categories,
        ])
            ->layout('layouts.reservations');
    }
}
