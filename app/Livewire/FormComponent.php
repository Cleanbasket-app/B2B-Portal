<?php

namespace App\Livewire;

use Livewire\Component;

class FormComponent extends Component
{
    public string $name = '';

    public function submit(): void
    {
        // Placeholder for form submission logic
        $this->dispatch('form-submitted');
    }

    public function render()
    {
        return view('livewire.form-component');
    }
}
