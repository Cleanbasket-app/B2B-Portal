<?php

namespace App\Livewire;

use Livewire\Component;

class ModalComponent extends Component
{
    public bool $show = false;

    public function open(): void
    {
        $this->show = true;
    }

    public function close(): void
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.modal-component');
    }
}
