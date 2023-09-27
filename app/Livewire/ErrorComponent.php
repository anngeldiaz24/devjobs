<?php

namespace App\Livewire;

use Livewire\Component;

class ErrorComponent extends Component
{
    //Recibe esta variable del componente <livewire:error-component :message="$message" />
    public $message;

    public function render()
    {
        return view('livewire.error-component');
    }
}
