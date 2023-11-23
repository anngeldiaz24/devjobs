<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;

class VacanteController extends Controller
{
    /* php artisan make:controller UsersController --resource */
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Se le pasa el modelo para que solo el reclutador pueda visualizar la interfaz 
        $this->authorize('viewAny', Vacante::class);
        return view('vacantes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $this->authorize('viewAny', Vacante::class);
        return view('vacantes.create');
    }


    /**
     * Display the specified resource.
     */
    public function show(Vacante $vacante)
    {
        return view('vacantes.show', [
            'vacante' => $vacante
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacante $vacante)
    {
        /* php artisan make:policy VacantePolicy --model=Vacante */
        /* Policies::update */
        $this->authorize('update', $vacante);

        return view('vacantes.edit', [
            'vacante' => $vacante
        ]);        
    }

    
}
