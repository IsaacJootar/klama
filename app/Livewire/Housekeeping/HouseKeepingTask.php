<?php

namespace App\Livewire\Housekeeping;

use App\Models\HouseHousekeepingTask;
use App\Models\Room;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Flasher\Toastr\Prime\ToastrInterface;


#[title('Housekeeping | HouseKeeping Task')]


class HouseKeepingTask extends Component
{
    public $users; // List of housekeeping tasks
    public $tasks; // List of housekeeping tasks
    public $rooms; // List of housekeeping tasks
    public $room_id, $staff_id, $task_description, $task_status, $priority, $scheduled_date, $completed_date; // Form fields
    public $task_id; // For editing
    public  $modal_flag = false; //  flag for edit
    public $modal_title = 'Add HouseKeeping Task.';

    protected $rules = [
        'room_id' => 'required',
        'staff_id' => 'required',
        'task_description' => 'required|string|max:1000',
        'task_status' => 'required',
        'priority' => 'required|in:Low,Medium,High',
        'scheduled_date' => 'nullable|date',
        'completed_date' => 'nullable|date',
    ];
    public function render()
    {
        $this->tasks = HouseHousekeepingTask::all();
        $this->rooms = Room::all();
        $this->users = User::all();

        return view('livewire.housekeeping.house-keeping-task')->layout('layouts.housekeeping');
    }


    // Reset form fields
    public function exit()
    {
        $this->reset(); //keyword
    }

    // Save a new or updated Housekeeping Task
    public function save()
    {
        //dd($this->name);
        //dd($this->category_id);

        $this->validate();

        HouseHousekeepingTask::updateOrCreate(
            ['id' => $this->task_id],
            [
                'room_id' => $this->room_id,
                'staff_id' => 1,
                'task_description' => $this->task_description,
                'task_status' => $this->task_status,
                'priority' => $this->priority,
                'scheduled_date' => $this->scheduled_date,
                'completed_date' => $this->completed_date,
            ]
        );

        toastr()->info( $this->task_id ? 'Housekeeping Task updated successfully!' : 'Housekeeping Task created successfully!');
        $this->reset(); //reset the fields
    }

    // Edit an existing Housekeeping Task
    public function edit($id)
    {
        $task = HouseHousekeepingTask::findOrFail($id);
        $this->task_id = $task->id;
        $this->room_id = $task->room_id;
        $this->staff_id = $task->staff_id;
        $this->task_description = $task->task_description;
        $this->task_status = $task->task_status;
        $this->priority = $task->priority;
        $this->scheduled_date = $task->scheduled_date;
        $this->completed_date = $task->completed_date;
        $this->modal_flag = true;
        $this->modal_title = 'Update Housekeeping Task';
    }

    // Delete an Housekeeping Task
    public function delete($id)
    {
        HouseHousekeepingTask::findOrFail($id)->delete();
        toastr()->info( 'Housekeeping Task deleted successfully!');
    }




}
