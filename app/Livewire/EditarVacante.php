<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EditarVacante extends Component
{
    public $vacante_id;
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    public $imagen_nueva;
    
    use WithFileUploads;

    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen_nueva' => 'nullable|image|max:1024',
        /* 'imagen' => 'required|image|max:1024', */
    ];
    
    /* Se ejecuta una vez el instanciado
    y obtiene la información para poner los datos en los input */
    public function mount(Vacante $vacante)
    {
        $this->vacante_id = $vacante->id; //Se asigna la variable de la BD a vacante_id
        //Le pasamos las variables como en la base de datos
        $this->titulo = $vacante->titulo;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        $this->empresa = $vacante->empresa;
        /* Formatea la fecha de yyyy-mm-dd a dd-mm-yyyy */
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d');
        $this->descripcion = $vacante->descripcion;
        $this->imagen = $vacante->imagen;
    }

    public function editarVacante()
    {
        $datos = $this->validate();

        //If there is a new image
        if ($this->imagen_nueva) {
            $imagen = $this->imagen_nueva->store('public/vacantes');
            $datos['imagen'] = str_replace('public/vacantes/', '', $imagen);
        }

        //We need to find the vacancy we will edit
        //Esto lo extrae de la base de datos
        $vacante = Vacante::find($this->vacante_id);

        //Asign new values
        $vacante->titulo = $datos['titulo'];
        $vacante->salario_id = $datos['salario'];
        $vacante->categoria_id = $datos['categoria'];
        $vacante->empresa = $datos['empresa'];
        $vacante->ultimo_dia = $datos['ultimo_dia'];
        $vacante->descripcion = $datos['descripcion'];
        /* Si hay nueva imagen, guardala, sino, conservala */
        $vacante->imagen = $datos['imagen'] ?? $vacante->imagen;

        //Save changes
        $vacante->save();

        //Redirect
        session()->flash('mensaje', 'The Vacancy was updated successfully');
        return redirect()->route('vacantes.index');


    }



    public function render()
    {
        //Fetch data from salarios_table
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.editar-vacante',[
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
