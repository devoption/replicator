<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class StatusPing extends Component
{
    public function render(): View
    {
        return view('livewire.status-ping');
    }
}
