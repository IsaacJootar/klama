<?php

namespace App\Livewire\Fnb;

use App\Models\FnbReport;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use App\Services\ReportFilesService;
use Spatie\LivewireFilepond\WithFilePond;
use Illuminate\Support\Facades\DB;

#[Title('Food & Beverage | Reports')]
class FnbReports extends Component
{
    use WithFilePond; // FilePond file upload library
    public  $reports; // report instance

    public $report;
    public $sent_by = '';
    public $sent_to;
    public $user_id = ''; 

    public $report_id; // give me a random numberto identify each report
    public $section = 'Food & Beverage';

    public $files = []; // Uploaded files (PDFs, images, etc.)

    #[Validate('required')]
    public $total_orders;

    #[Validate('required|min:10')]
    public $notes;

    #[Validate('required')]
    public $total_revenue;

    #[Validate('required')]
    public $wastage;

    #[Validate('required')]
    public $complaints_received;

    #[Validate('required')]
    public $special_requests;

    #[Validate('required')]
    public $inventory_used;

    #[Validate('required')]
    public $inventory_remaining;

    #[Validate('required')]
    public $amount;

    public $modal_title = 'Send Report';
    public $modal_flag = false; // Edit flag

      public function save()
        {
            $this->validate(); // validate your own unique section summary inputs report fileds

            $this->report_id = mt_rand(100000, 999999); // give me a random number
            //$this->report_id = substr(   $this->report_id, -5);
    
    
            
    
        // Get the user ID of the General Manager
            $this->sent_to = DB::table('user_roles')
            ->where('role', 'General_Manager')
            ->value('user_id');

        FnbReport::updateOrCreate(
            ['id' => $this->report_id],
            [
                'report_id' => $this->report_id,
                'total_orders' => $this->total_orders,
                'total_revenue' => $this->total_revenue,
                'wastage' => $this->wastage,
                'complaints_received' => $this->complaints_received,
                'special_requests' => $this->special_requests,
                'inventory_used' => $this->inventory_used,
                'inventory_remaining' => $this->inventory_remaining,
                'amount' => $this->amount,
                'notes' => $this->notes,
                'user_id' => Auth::user()->id,
                'sent_to' => $this->sent_to,
                'sent_by' => Auth::user()->id,
                'section' => $this->section,
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
    
    
     public function exit()
    {
        $this->reset();
    }


    public function render()
    {
        $this->reports = FnbReport::all();
        return view('livewire.fnb.fnb-reports')->layout('layouts.fnb');
    }
}
