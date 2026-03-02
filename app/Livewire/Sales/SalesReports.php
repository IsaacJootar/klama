<?php

namespace App\Livewire\Sales;

use App\Models\SalesReport;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Services\ReportFilesService; // Dependency Injection for file handling
use Livewire\Attributes\Validate;
//use Spatie\LivewireFilepond\WithFilePond;

#[Title('Sales | Reports')]
class SalesReports extends Component
{
   // use WithFilePond; // FilePond file upload library

    public $reports; // Reports collection
    public $report;
    public $sent_by = '12345'; // Hardcoded user ID until authentication is ready
    public $sent_to;
    public $user_id = '12345'; // Hardcoded user ID for now
    public $report_id; // Unique identifier for each report
    public $section = 'Sales'; // Department name

    public $files = []; // Files (images, PDFs, etc.)
    #[Validate('required')]
    public $total_sales;

    #[Validate('required|min:10')]
    public $note;

    #[Validate('required')]
    public $revenue_generated;

    #[Validate('required')]
    public $new_clients;

    #[Validate('required')]
    public $follow_ups;

    #[Validate('required')]
    public $deals_closed;

    #[Validate('required')]
    public $refunds_processed;

    #[Validate('required')]
    public $amount;

    public $modal_title = 'Send Report.';
    public $modal_flag = false; // Flag for edit mode

    public function save()
    {
        $this->validate(); // Validate required fields

        SalesReport::updateOrCreate(
            ['id' => $this->report_id],
            [
                'report_id' => $this->report_id ?? mt_rand(10000000, 99999999),
                'total_sales' => $this->total_sales,
                'revenue_generated' => $this->revenue_generated,
                'new_clients' => $this->new_clients,
                'follow_ups' => $this->follow_ups,
                'deals_closed' => $this->deals_closed,
                'refunds_processed' => $this->refunds_processed,
                'amount' => $this->amount,
                'note' => $this->note,
                'sent_to' => $this->sent_to,
                'sent_by' => $this->sent_by,
                'section' => $this->section,
            ]
        );

        // Upload files if available
        if ($this->files) {
            $report_files_service = app(ReportFilesService::class);

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

        toastr()->info($this->modal_flag ? 'Report Has Been Updated Successfully' : 'Report Has Been Sent Successfully');
        $this->reset();
    }

    public function edit($id)
    {
        $this->report = SalesReport::findOrFail($id);
        $this->report_id = $this->report->id;
        $this->total_sales = $this->report->total_sales;
        $this->revenue_generated = $this->report->revenue_generated;
        $this->new_clients = $this->report->new_clients;
        $this->follow_ups = $this->report->follow_ups;
        $this->deals_closed = $this->report->deals_closed;
        $this->refunds_processed = $this->report->refunds_processed;
        $this->amount = $this->report->amount;
        $this->note = $this->report->note;
        $this->sent_to = $this->report->sent_to;
        $this->modal_flag = true;
        $this->modal_title = 'Update Report';
    }

    public function exit()
    {
        $this->reset();
    }

    public function render()
    {
        $this->reports = SalesReport::all();
        return view('livewire.sales.sales-reports')->layout('layouts.sales');
    }
}
