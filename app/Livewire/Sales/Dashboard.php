<?php

namespace App\Livewire\Sales;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Sales | Dashboard')]

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.sales.dashboard')->layout('layouts.sales');
    }
}
