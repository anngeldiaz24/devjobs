<?php

namespace App\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CrearVacante extends Component
{
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    


    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:1024',
    ];

    //Permite la subida de archivos
    use WithFileUploads;

    public function crearVacante()
    {
        //valida las rules 
        $datos = $this->validate();

        //Store the image
        //Directory storage
        $imagen = $this->imagen->store('public/vacantes');
        //Elimina el directorio y unicamente guardamos el nombre del archivo
        $nombre_imagen = str_replace('public/vacantes/', '', $imagen);
        dd($nombre_imagen);
    }

    public function render()
    {
        //Fetch data from salarios_table
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.crear-vacante',[
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
