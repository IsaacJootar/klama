<?php

namespace App\Livewire\Maintenance;

use App\Models\MaintSchedule;
use Livewire\Component;
use App\Models\MaintAsset;
use App\Models\MaintTechnician;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Flasher\Toastr\Prime\ToastrInterface;


#[title('Maintenance | Maintenance Schedule')]
class Schedules extends Component
{
    public $schedules;
    public $assets; // List of all assets
    public $technicians; // List of all assets technician
    public $id, $task_name, $asset_id, $frequency, $next_scheduled_date, $assigned_to, $status, $schedule_id;
    public  $modal_flag = false; //  flag for edit
    public $modal_title = 'Add New Maintenance Schedule.';


    protected $rules = [
        'task_name' => 'required|string',
        'asset_id' => 'required',
        'frequency' => 'required|in:Daily,Weekly,Monthly,Quarterly,Yearly',
        'next_scheduled_date' => 'required|date',
        'assigned_to' => 'required',
        'status' => 'required|in:Scheduled,In Progress,Completed',
    ];
    public function render()
    {
        // Fetch all assets to display
        $this->schedules = MaintSchedule::all();
        $this->assets = MaintAsset::all();
        $this->technicians = MaintTechnician::all();
        return view('livewire.maintenance.schedules')->layout('layouts.maintenance');
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


     MaintSchedule::updateOrCreate(
         ['id' => $this->id],
         [
            'task_name' => $this->task_name,
            'asset_id' => $this->asset_id,
            'frequency' => $this->frequency,
            'next_scheduled_date' => $this->next_scheduled_date,
            'assigned_to' => $this->assigned_to,
            'status' => $this->status,
         ]
     );

     toastr()->info( $this->id ? 'Schedules updated successfully!' : 'Schedules created successfully!');
     $this->reset();
    }

 // Edit an existing asset
 public function edit($id)
 {
     $schedule = MaintSchedule::findOrFail($id);
     $this->id = $schedule->id;
     $this->task_name = $schedule->task_name;
     $this->asset_id = $schedule->asset_id;
     $this->frequency = $schedule->frequency;
     $this->next_scheduled_date = $schedule->next_scheduled_date;
     $this->assigned_to = $schedule->assigned_to;
     $this->status = $schedule->status;

     $this->modal_flag = true;
     $this->modal_title = 'Update Maintenance Schedule';
 }

 // Delete an asset
 public function delete($id)
 {
    MaintSchedule::findOrFail($id)->delete();
      toastr()->info('Schedules deleted successfully!');
 }
}
