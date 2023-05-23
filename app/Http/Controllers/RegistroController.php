<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Registro;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $successMessage = session('successMessage');

        $registros = Registro::orderBy('datahora', 'desc')->take(50)->get();

        return view('registros.index')
            ->with('registros', $registros)
            ->with('successMessage', $successMessage);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $funcionarios = Funcionario::where('ativo', true)->orderBy('nome')->get();
        return view('registros.create')
            ->with('funcionarios', $funcionarios)
            ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['manual' => true]);
        $request->merge(['latitude' => '0']);
        $request->merge(['longitude' => '0']);

        Registro::create($request->all());

        return to_route('registros.index')
            ->with('successMessage', 'Registro cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Registro $registro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Registro $registro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Registro $registro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registro $registro)
    {
        //
    }
}
