<?php

namespace App\Livewire;

use Livewire\Component;

class TableComponent extends Component
{
    public array $headers = [];
    public array $rows = [];

    public function render()
    {
        return view('livewire.table-component');
    }
}
