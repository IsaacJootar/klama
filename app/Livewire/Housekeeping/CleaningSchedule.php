<?php

namespace App\Livewire\Housekeeping;

use App\Models\HouseCleaningSchedule;
use App\Models\Room;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Flasher\Toastr\Prime\ToastrInterface;


#[title('Housekeeping | Cleaning Schedule')]


class CleaningSchedule extends Component
{
    public $schedules; // List of cleaning schedules
    public $users; // list of users
    public $rooms; // List of cleaning schedules
    public $room_id, $user_id, $cleaning_date, $shift, $status; // Form fields
    public $schedule_id; // For editing
    public  $modal_flag = false; //  flag for edit
    public $modal_title = 'Add Cleaning Schedule.';

    protected $rules = [
        'room_id' => 'required',
        'user_id' => 'required',
        'cleaning_date' => 'required|date',
        'shift' => 'required|in:Morning,Afternoon,Evening',
        'status' => 'required|in:Scheduled,Completed,Skipped',
    ];

    public function render()
    {
        $this->schedules = HouseCleaningSchedule::all();
        $this->rooms = Room::all();
        $this->users = User::all(); // Filter housekeeping staff if applicable

        return view('livewire.housekeeping.cleaning-schedule')->layout('layouts.housekeeping');
    }

    // Reset form fields
    public function exit()
    {
        $this->reset(); //keyword
    }

    // Save a new or updated Cleaning Schedule
    public function save()
    {
        //dd($this->name);
        //dd($this->category_id);

        $this->validate();

        HouseCleaningSchedule::updateOrCreate(
            ['id' => $this->schedule_id],
            [
                'room_id' => $this->room_id,
                'user_id' => $this->user_id,
                'cleaning_date' => $this->cleaning_date,
                'shift' => $this->shift,
                'status' => $this->status,
            ]
        );

        toastr()->info( $this->schedule_id ? 'Cleaning Schedule updated successfully!' : 'Cleaning Schedule created successfully!');
        $this->reset(); //reset the fields
    }

    // Edit an existing Cleaning Schedule
    public function edit($id)
    {
        $schedule = HouseCleaningSchedule::findOrFail($id);
        $this->schedule_id = $schedule->id;
        $this->room_id = $schedule->room_id;
        $this->user_id = $schedule->user_id;
        $this->cleaning_date = $schedule->cleaning_date;
        $this->shift = $schedule->shift;
        $this->status = $schedule->status;
        $this->modal_flag = true;
        $this->modal_title = 'Update Cleaning Schedule';
    }

    // Delete an Cleaning Schedule
    public function delete($id)
    {
        HouseCleaningSchedule::findOrFail($id)->delete();
        toastr()->info( 'Cleaning Schedule deleted successfully!');
    }




}
