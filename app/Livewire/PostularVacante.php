<?php

namespace App\Livewire;

use Livewire\Component;

class PostularVacante extends Component
{

    public $cv;

    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];

    public function postularme()
    {
        $this->validate();
        
        //Store cv in the server

        //Create a notificación and send email

        //show a succesfull message to the user 

    }


    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
