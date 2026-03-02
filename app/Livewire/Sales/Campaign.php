<?php

namespace App\Livewire\Sales;

use Livewire\Component;
use App\Models\SalesCampaign;
use Livewire\Attributes\Title;

#[Title('Sales | Campaign Management')]
class Campaign extends Component
{
    public $campaigns;
    public $campaign_id;
    public $campaign_name;
    public $campaign_type = 'email'; // default type
    public $description;
    public $start_date;
    public $end_date;
    public $budget;
    public $performance_metrics;
    public $status = 'planned';

    public $modal_flag = false; // Flag for showing modal
    public $modal_title = 'Create New Campaign';

    protected $rules = [
        'campaign_name' => 'required|string|max:255',
        'campaign_type' => 'required|in:email,social_media',
        'description'   => 'nullable|string',
        'start_date'    => 'required|date',
        'end_date'      => 'required|date|after_or_equal:start_date',
        'budget'        => 'nullable|numeric|min:0',
        // For performance_metrics, you can validate as nullable JSON or leave it as is
        'status'        => 'required|in:planned,active,completed,cancelled',
    ];

    public function render()
    {
        $this->campaigns = SalesCampaign::all();
        return view('livewire.sales.campaign')->layout('layouts.sales');
    }

    // Reset form fields
    public function exit()
    {
        $this->reset();
    }

    // Save a new or updated campaign
    public function save()
    {
        $this->validate();

        SalesCampaign::updateOrCreate(
            ['id' => $this->campaign_id],
            [
                'campaign_name'       => $this->campaign_name,
                'campaign_type'       => $this->campaign_type,
                'description'         => $this->description,
                'start_date'          => $this->start_date,
                'end_date'            => $this->end_date,
                'budget'              => $this->budget,
                'performance_metrics' => $this->performance_metrics,
                'status'              => $this->status,
            ]
        );

        toastr()->info($this->campaign_id ? 'Campaign updated successfully!' : 'Campaign created successfully!');
        $this->reset();
    }

    // Edit an existing campaign
    public function edit($id)
    {
        $campaign = SalesCampaign::findOrFail($id);
        $this->campaign_id       = $campaign->id;
        $this->campaign_name     = $campaign->campaign_name;
        $this->campaign_type     = $campaign->campaign_type;
        $this->description       = $campaign->description;
        $this->start_date        = $campaign->start_date->format('Y-m-d');
        $this->end_date          = $campaign->end_date->format('Y-m-d');
        $this->budget            = $campaign->budget;
        $this->performance_metrics = $campaign->performance_metrics;
        $this->status            = $campaign->status;
        $this->modal_flag        = true;
        $this->modal_title       = 'Update Campaign';
    }

    // Delete an existing campaign
    public function delete($id)
    {
        SalesCampaign::findOrFail($id)->delete();
        toastr()->info('Campaign deleted successfully!');
    }
}
