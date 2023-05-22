<?php

namespace App\Http\Controllers;

use App\Models\Feriado;
use Illuminate\Http\Request;

class FeriadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $successMessage = session('successMessage');
        //buscar funcionarios ativos 
        $feriados = Feriado::all();

        return view('feriados.index')
            ->with('feriados', $feriados)
            ->with('successMessage', $successMessage);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Feriado $feriado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feriado $feriado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feriado $feriado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feriado $feriado)
    {
        //
    }
}