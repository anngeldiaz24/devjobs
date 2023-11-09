<?php

namespace App\Livewire;
use App\Models\Vacante;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class ListadoVacantes extends Component
{
    use WithPagination;

    //Lo necesitamos para el emit que mandamos desde wire:click="$emit('prueba')"
    /* protected $listeners = ['prueba'];

    public function test()
    {
        dd('hola');
    } */

    #[On('eliminarVacante')]
    public function eliminarVacante(Vacante $vacante)
    {
        /* dd($vacante->id); */
        $vacante->delete();
    }

    public function render()
    {
        $vacantes = Vacante::where('user_id', auth()->user()->id)->paginate(10);
        return view('livewire.listado-vacantes', [
            'vacantes' => $vacantes
        ]);
    }
}

