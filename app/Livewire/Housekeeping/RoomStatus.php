<?php

namespace App\Livewire\Housekeeping;

use App\Models\HouseRoomStatus;
use App\Models\Room;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Flasher\Toastr\Prime\ToastrInterface;


#[title('Housekeeping | Room Status')]

class RoomStatus extends Component
{
    public $rooms; // List of room statuses
    public $Statuses; // List of room statuses
    public $room_id, $status, $last_cleaned_at, $next_cleaning_due; // Form fields
    public $status_id; // For editing
    public  $modal_flag = false; //  flag for edit
    public $modal_title = 'Add Housekeeping Status.';

    protected $rules = [
        'room_id' => 'required',
        'status' => 'required|in:Clean,Dirty,Under Maintenance',
        'last_cleaned_at' => 'nullable|date',
        'next_cleaning_due' => 'nullable|date',
    ];

    public function render()
    {
        $this->Statuses = HouseRoomStatus::with('room')->get();
        $this->rooms = Room::all();
        return view('livewire.housekeeping.room-status')->layout('layouts.housekeeping');
    }

    // Reset form fields
    public function exit()
    {
        $this->reset(); //keyword
    }

    // Save a new or updated Room Status
    public function save()
    {
        //dd($this->name);
        //dd($this->category_id);

        $this->validate();

        HouseRoomStatus::updateOrCreate(
            ['id' => $this->status_id],
            [
                'room_id' => $this->room_id,
                'status' => $this->status,
                'last_cleaned_at' => $this->last_cleaned_at,
                'next_cleaning_due' => $this->next_cleaning_due,
            ]
        );

        toastr()->info( $this->status_id ? 'Room Status updated successfully!' : 'Room Status created successfully!');
        $this->reset(); //reset the fields
    }

    // Edit an existing Room Status
    public function edit($id)
    {
        $status  = HouseRoomStatus::findOrFail($id);
        $this->status_id = $status->id;
        $this->room_id = $status->room_id;
        $this->status = $status->status;
        $this->last_cleaned_at = $status->last_cleaned_at;
        $this->next_cleaning_due = $status->next_cleaning_due;
        $this->modal_flag = true;
        $this->modal_title = 'Update Room Status';
    }

    // Delete an Room Status
    public function delete($id)
    {
        HouseRoomStatus::findOrFail($id)->delete();
        toastr()->info( 'Room Status deleted successfully!');
    }




}
