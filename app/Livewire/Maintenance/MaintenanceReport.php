<?php

namespace App\Livewire\Maintenance;

use App\Models\MaintReport;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use App\Services\ReportFilesService;
use Spatie\LivewireFilepond\WithFilePond;
use Illuminate\Support\Facades\DB;

#[Title('Maintenance | Reports')]
class MaintenanceReport extends Component
{
    use WithFilePond; // FilePond file upload library

    public $reports; // Collection of maintenance reports
    public $report;  // Single maintenance report instance

    public $sent_by = '';
    public $sent_to;
    public $user_id = ''; // Hardcoded for now until Auth module is ready

    public $report_id; // Unique identifier for each report (randomly generated)
    public $section = 'Maintenance'; // Section identifier

    // File uploads
    public $files = [];

    // Maintenance report fields with validations
    #[Validate('required')]
    public $equipment_checked;

    #[Validate('required')]
    public $repairs_done;

    #[Validate('required')]
    public $faults_reported;

    #[Validate('required')]
    public $emergency_repairs;

    #[Validate('required')]
    public $scheduled_maintenance;

    #[Validate('required')]
    public $amount;

    #[Validate('required|min:10')]
    public $notes;

    public $modal_title = 'Send Report.';
    public $modal_flag = false; // Flag for edit

    public function save()
    {
        $this->validate(); // validate your own unique section summary inputs report fileds
        $this->Auth::user()->id;
        $this->report_id = mt_rand(100000, 999999); // give me a random number
        //$this->report_id = substr(   $this->report_id, -5);


        

    // Get the user ID of the General Manager
        $this->sent_to = DB::table('user_roles')
        ->where('role', 'General_Manager')
        ->value('user_id');

        // Create or update the maintenance report
        MaintReport::updateOrCreate(
            ['id' => $this->report_id],
            [
                // Generate a random report_id if this is a new record
                'report_id'              => $this->report_id,
                'equipment_checked'      => $this->equipment_checked,
                'repairs_done'           => $this->repairs_done,
                'faults_reported'        => $this->faults_reported,
                'emergency_repairs'      => $this->emergency_repairs,
                'scheduled_maintenance'  => $this->scheduled_maintenance,
                'amount'                 => $this->amount,
                'notes'                  => $this->notes,
                'sent_to'                => $this->sent_to,
                'sent_by'                => $this->sent_by,
                'section'                => $this->section,
            ]
        );

        if ($this->files) { // uploading files for daily reports may not be neccessary every day, but if files exist, inject the dependency
            $report_files_service = app(ReportFilesService::class); // inject the dependency class

            $this->sent_by = Auth::user()->id;
            foreach ($this->files as $file) {
                $report_files_service->UploadFilesAndCreateRecord($file, $this->report_id,  $this->sent_by, $this->sent_to, $this->sent_by, $this->section);
            }

        }

        toastr()->info('Report Has Been Sent Successfuly'); // even if files were not uploaded
        $this->reset();


    }

    // public function edit($id)
    // {
    //     $this->report = MaintReport::findOrFail($id);
    //     $this->report_id             = $this->report->id;
    //     $this->equipment_checked     = $this->report->equipment_checked;
    //     $this->repairs_done          = $this->report->repairs_done;
    //     $this->faults_reported       = $this->report->faults_reported;
    //     $this->emergency_repairs     = $this->report->emergency_repairs;
    //     $this->scheduled_maintenance = $this->report->scheduled_maintenance;
    //     $this->amount                = $this->report->amount;
    //     $this->notes                 = $this->report->notes;
    //     $this->sent_to               = $this->report->sent_to;
    //     $this->modal_flag            = true; // Set flag for updating an existing record
    //     $this->modal_title           = 'Update Report';
    // }

    // public function exit()
    // {
    //     // Reset modal fields when exiting
    //     $this->reset();
    // }

    /*
    // Uncomment to allow deletion of reports
    public function destroy($id)
    {
        $report = MaintenanceReport::findOrFail($id);
        $report->delete();
        toastr()->info('Report Item has been deleted successfully');
    }
    */

    public function render()
    {
        $this->reports = MaintReport::all();
        return view('livewire.maintenance.maintenance-report')->layout('layouts.maintenance');
    }
}
