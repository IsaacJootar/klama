<?php

namespace App\Livewire\Reservations;

use Livewire\Attributes\Title;
use App\Models\Roomallocation;
use Livewire\Component;
use Livewire\Attributes\On;

#[Title('Reservations | Room Allocation')]
class HomeCreateRoomAllocation extends Component
{
    public $allocations;

    public function mount()
    {
        $this->allocations = Roomallocation::all();
    }
    // Event Handler for  re-rendering room allocation view
    #[On('refresh-allocations')]
    public function refreshroomAllocation()
    {
        $this->allocations = Roomallocation::all();
    }


    public function destroyAllocation($id)
    {
        $allocations = Roomallocation::findOrFail($id);
        $allocations->delete();
        toastr()->info('Room Allocation is Removed successfully');
        $this->redirect('/reservations/home-create-room-allocation');
    }


    public function render()
    {
        return view('livewire.reservations.home-create-room-allocation')
            ->layout('layouts.reservations');
    }
}
