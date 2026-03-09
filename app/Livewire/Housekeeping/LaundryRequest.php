<?php

namespace App\Livewire\Housekeeping;

use App\Models\HouseLaundryRequest;
use App\Models\Room;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[title('Housekeeping | Laundry Request')]
class LaundryRequest extends Component
{
    public $rooms;
    public $requests;
    public $request_id;
    public $guest_name;
    public $room_id;
    public $items;
    public $total_cost;
    public $status = 'Received';
    public $requested_at;
    public $notes;
    public $amount_received;
    public $service_type = 'Full Service';
    public $modal_flag = false;
    public $modal_title = 'Create New Laundry Request';
    public $deliver_modal_flag = false;
    public $deliver_modal_title = 'Mark Laundry Request as Delivered';

    protected $rules = [
        'guest_name' => 'required|string',
        'room_id' => 'required|exists:resv_rooms,id',
        'items' => 'required|string',
        'total_cost' => 'required|numeric|min:0',
        'status' => 'required|in:Received,Delivered',
        'requested_at' => 'nullable|date',
        'notes' => 'nullable|string',
        'service_type' => 'required|in:Wash,Dry Clean,Ironing,Wash and Iron,Full Service',
        'amount_received' => 'nullable|required_if:status,Delivered|numeric|min:0',
    ];

    public function render()
    {
        $this->requests = HouseLaundryRequest::all();
        $this->rooms = Room::all();
        return view('livewire.housekeeping.laundry-request')->layout('layouts.housekeeping');
    }

    public function exit()
    {
        $this->reset(['request_id', 'guest_name', 'room_id', 'items', 'total_cost', 'status', 'requested_at', 'notes', 'service_type', 'amount_received']);
        $this->modal_flag = false;
        $this->deliver_modal_flag = false;
        $this->modal_title = 'Create New Laundry Request';
        $this->deliver_modal_title = 'Mark Laundry Request as Delivered';
    }

    public function save()
    {
        $this->validate();

        HouseLaundryRequest::updateOrCreate(
            ['id' => $this->request_id],
            [
                'guest_name' => $this->guest_name,
                'room_id' => $this->room_id,
                'items' => $this->items,
                'total_cost' => $this->total_cost,
                'status' => $this->status,
                'requested_at' => $this->requested_at ?? now(),
                'notes' => $this->notes,
                'service_type' => $this->service_type,
                'payment_status' => $this->status === 'Delivered' ? 'Paid' : null,
                'amount_received' => $this->status === 'Delivered' ? (float)$this->amount_received : null,
            ]
        );

        toastr()->info($this->request_id ? 'Laundry Request updated successfully!' : 'Laundry Request created successfully!');
        $this->exit();
    }

    public function edit($id)
    {
        $request = HouseLaundryRequest::findOrFail($id);
        $this->request_id = $request->id;
        $this->guest_name = $request->guest_name;
        $this->room_id = $request->room_id;
        $this->items = $request->items;
        $this->total_cost = $request->total_cost;
        $this->status = $request->status;
        $this->requested_at = $request->requested_at ? $request->requested_at->format('Y-m-d H:i:s') : null;
        $this->notes = $request->notes;
        $this->service_type = $request->service_type;
        $this->amount_received = $request->amount_received;
        $this->modal_flag = true;
        $this->modal_title = 'Update Laundry Request';
    }

    public function markDelivered($id)
    {
        $request = HouseLaundryRequest::findOrFail($id);
        $this->request_id = $request->id;
        $this->guest_name = $request->guest_name;
        $this->room_id = $request->room_id;
        $this->items = $request->items;
        $this->total_cost = $request->total_cost;
        $this->status = 'Delivered';
        $this->requested_at = $request->requested_at ? $request->requested_at->format('Y-m-d H:i:s') : null;
        $this->notes = $request->notes;
        $this->service_type = $request->service_type;
        $this->amount_received = $request->amount_received ?? $request->total_cost;
        $this->deliver_modal_flag = true;
        $this->deliver_modal_title = 'Mark Laundry Request as Delivered';
    }

    public function saveDelivered()
    {
        $this->validate([
            'amount_received' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        HouseLaundryRequest::where('id', $this->request_id)->update([
            'status' => 'Delivered',
            'payment_status' => 'Paid',
            'amount_received' => (float)$this->amount_received,
            'notes' => $this->notes,
            'updated_at' => now(),
        ]);

        toastr()->info('Laundry Request marked as Delivered!');
        $this->exit();
    }

    public function delete($id)
    {
        //HouseLaundryRequest::findOrFail($id)->delete();
        toastr()->error('Laundry Request deletion is disabled!');
    }
}