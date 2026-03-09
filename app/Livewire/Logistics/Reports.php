<?php
namespace App\Livewire\Logistics;
use App\Models\Report;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use App\Services\ReportFilesService;
use Spatie\LivewireFilepond\WithFilePond;
use Illuminate\Support\Facades\DB;


#[Title('Logistics | Reports')]
class Reports extends Component
{

    use WithFilePond; // FilePond file upload library
    public  $reports; // report instance

    public $report;
    public $sent_by = '';
    public $sent_to;
    public $user_id = ''; 

    public $report_id; // give me a random numberto identify each report

    public $section = 'Logistics'; //Hotel Section,like depart


    public $files = []; // image, Docs,PDFs, etc
    #[Validate('required')]
    public $trips_made;

    #[Validate('required|min:10')]
    public $note;


    #[Validate('required|integer')]
    public $airport_pickups;

    #[Validate('required|integer')]
    public $other;
    #[Validate('required|integer')]
    public $breakdowns;
    public $modal_title = 'Send Report.';
    public  $modal_flag = false; // flag for edit




    public function save()
    {
        $this->validate(); // validate your own unique section summary inputs report fileds

        $this->report_id = mt_rand(100000, 999999); // give me a random number
        //$this->report_id = substr(   $this->report_id, -5);


        

    // Get the user ID of the General Manager
        $this->sent_to = DB::table('user_roles')
        ->where('role', 'General_Manager')
        ->value('user_id');


        Report::updateOrCreate(
            ['id' => $this->report_id],
            [
                'report_id' => $this->report_id ,
                'trips_made' => $this->trips_made,
                'airport_pickups' => $this->airport_pickups,
                'other' => $this->other,
                'breakdowns' => $this->breakdowns,
                'note' => $this->note,
                'sent_to' => $this->sent_to,
                'sent_by' =>  Auth::user()->id, // Auth User ID
                'date' => Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d'), // create a class later to accomodate other timezones
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

    /* No editing of reports for now
    public function edit($id)
    {
        $this->report = Report::findOrFail($id);
        $this->report_id = $this->report->id;
        $this->trips_made = $this->report->trips_made;
        $this->airport_pickups = $this->report->airport_pickups;
        $this->other = $this->report->other;
        $this->breakdowns = $this->report->breakdowns;
        $this->note = $this->report->note;
        $this->sent_to = $this->report->sent_to;
        $this->modal_flag = true; // for update
        $this->modal_title = 'Update Report';
    }
*/


    /*
    dont delete reports for now

    public function destroy($id)
    {
        $report = report::findOrFail($id);
        $report->delete();
        toastr()->info('Report Item is deleted successfully');
    }
*/


    public function render()
    {
        $this->reports = Report::all();
        return view('livewire.logistics.reports')->layout('layouts.logistics');
    }
}
