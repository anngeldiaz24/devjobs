<?php

namespace App\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Vacante;
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
        //Storage directory 
        $imagen = $this->imagen->store('public/vacantes');
        //Elimina el directorio y unicamente guardamos el nombre del archivo
        $datos['imagen'] = str_replace('public/vacantes/', '', $imagen);
        //dd($nombre_imagen);
        
        //Crear vacante
        Vacante::create([
            'titulo' => $datos['titulo'], 
            'salario_id' => $datos['salario'],
            'categoria_id' => $datos['categoria'],
            'empresa' => $datos['empresa'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen' => $datos['imagen'],
            'user_id' => auth()->user()->id,
        ]);

        //Crear mensaje
        session()->flash('mensaje', 'The vacancy was published succesfully');

        //Redireccionar al usuario
        return redirect()->route('vacantes.index');
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
