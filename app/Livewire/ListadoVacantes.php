<?php

namespace App\Livewire;
use Livewire\WithPagination;
use App\Models\Vacante;
use Livewire\Component;

class ListadoVacantes extends Component
{
    use WithPagination;

    public function render()
    {
        $vacantes = Vacante::where('user_id', auth()->user()->id)->paginate(10);
        return view('livewire.listado-vacantes', [
            'vacantes' => $vacantes
        ]);
    }
}

