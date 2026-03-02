<?php

namespace App\Livewire\Housekeeping;

use App\Models\HouseReport;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Services\ReportFilesService; // Update with the actual namespace if needed
use Livewire\Attributes\Validate;
//use Spatie\LivewireFilepond\WithFilePond;

#[Title('House Reports | Reports')]
class HouseReports extends Component
{
   // use WithFilePond; // FilePond file upload library

    public $reports; // Collection of house reports
    public $report;  // Single house report instance

    public $sent_by = '12345';
    public $sent_to;
    public $user_id = '12345'; // Hardcoded User ID until Auth module is ready

    public $report_id; // Unique identifier for each report
    public $section = 'House Reports'; // Section name

    public $files = []; // For uploading images, docs, PDFs, etc.

    // House report fields with validations:
    #[Validate('required')]
    public $rooms_cleaned;

    #[Validate('required')]
    public $laundry_items_processed;

    #[Validate('required')]
    public $maintenance_requests;

    #[Validate('required')]
    public $deep_cleaning_tasks;

    #[Validate('required')]
    public $supplies_used;

    #[Validate('required')]
    public $amount;

    #[Validate('required|min:10')]
    public $note; // This will map to the 'notes' column in the database

    public $modal_title = 'Send Report.';
    public $modal_flag = false; // Flag for edit

    public function save()
    {
        $this->validate(); // Validate the input fields

        HouseReport::updateOrCreate(
            ['id' => $this->report_id],
            [
                // Generate a random report_id if this is a new record
                'report_id'              => $this->report_id = mt_rand(10000000, 99999999),
                'rooms_cleaned'          => $this->rooms_cleaned,
                'laundry_items_processed'=> $this->laundry_items_processed,
                'maintenance_requests'   => $this->maintenance_requests,
                'deep_cleaning_tasks'    => $this->deep_cleaning_tasks,
                'supplies_used'          => $this->supplies_used,
                'amount'                 => $this->amount,
                'notes'                  => $this->note,
                'sent_to'                => $this->sent_to,
                'sent_by'                => $this->sent_by,
                'section'                => $this->section,
            ]
        );

        if ($this->files) { // If files exist, handle file uploads
            $report_files_service = app(ReportFilesService::class); // Dependency injection

            foreach ($this->files as $file) {
                $report_files_service->UploadFilesAndCreateRecord(
                    $file,
                    $this->report_id,
                    $this->sent_by,
                    $this->sent_to,
                    $this->user_id,
                    $this->section
                );
            }
        }

        toastr()->info($this->report_id ? 'Report Has Been Updated Successfully' : 'Report Has Been Sent Successfully');
        $this->reset();
    }

    public function edit($id)
    {
        $this->report = HouseReport::findOrFail($id);
        $this->report_id = $this->report->id;
        $this->rooms_cleaned = $this->report->rooms_cleaned;
        $this->laundry_items_processed = $this->report->laundry_items_processed;
        $this->maintenance_requests = $this->report->maintenance_requests;
        $this->deep_cleaning_tasks = $this->report->deep_cleaning_tasks;
        $this->supplies_used = $this->report->supplies_used;
        $this->amount = $this->report->amount;
        $this->note = $this->report->notes;
        $this->sent_to = $this->report->sent_to;
        $this->modal_flag = true; // Set flag for updating an existing record
        $this->modal_title = 'Update Report';
    }

    public function exit()
    {
        // Reset all modal fields
        $this->reset();
    }

    public function render()
    {
        $this->reports = HouseReport::all();
        return view('livewire.housekeeping.house-reports')->layout('layouts.housekeeping');
    }
}
