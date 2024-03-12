<?php

namespace App\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class PostularVacante extends Component
{

    use WithFileUploads;
    public $cv;
    public $vacante;

    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];

    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    public function postularme()
    {
        $datos = $this->validate();

        //Store cv in the server
        $cv = $this->cv->store('public/cv');
        //Elimina el directorio y unicamente guardamos el nombre del archivo
        $datos['cv'] = str_replace('public/cv/', '', $cv);
        //dd($nombre_imagen);

        //Create the candidate 
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
            'cv' => $datos['cv'],
        ]);

        //Create a notificación and send email
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id ));

        //show a succesfull message to the user 
        session()->flash('mensaje', 'Your CV was sent successfully, good luck');

        return redirect()->back();
    }


    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
