<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Registro;
use DateTime;
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
            ->with('funcionarios', $funcionarios);
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
        $registro->delete();
        return to_route('registros.index')
            ->with('successMessage', 'Registro excluído com sucesso!');
    }

    public function relatorio(Request $request){

        $matricula = $request->input('matricula');
        $camposmes = $request->input('mes');
        $ano = substr($camposmes, 0, 4);
        $mes = substr($camposmes, 5, 2);

        $funcionario = Funcionario::where('matricula', $matricula)->first();
    
        $registros = Registro::whereMonth('datahora', $mes)
            ->whereYear('datahora', $ano)
            ->where('funcionario_id', $funcionario->id)
            ->orderBy('datahora')
            ->get()
            ->groupBy(function ($registro) {
                return \Carbon\Carbon::parse($registro->datahora)->format('d');
            });

        $arrayDias = $this->montarArrayDiasMes($ano, $mes);
        $arrayRegistros = $registros->toArray();
        $maiorNumeroDeRegistros = 0;
        
        foreach ($arrayDias as &$dia) {
            $indice = $dia['dia'];
        
            if (isset($arrayRegistros[$indice])) {
                $registros = $arrayRegistros[$indice];
                if (count($registros) > $maiorNumeroDeRegistros) {
                    $maiorNumeroDeRegistros = count($registros);
                }
        
                foreach ($registros as $registro) {
                    $hora = \Carbon\Carbon::parse($registro['datahora'])->format('H:i');
                    $dia['registros'][] = $hora;
                }
            }
        }
        
        unset($dia); // Remova a referência após o loop

        return view("pdf.relatorio")
            ->with('funcionario', $funcionario)
            ->with('dias', $arrayDias)
            ->with('mes', strtoupper($this->getMesPorExtenso($mes)))
            ->with('ano', $ano)
            ->with('maiorNumeroDeRegistros', $maiorNumeroDeRegistros);
    }

    function getMesPorExtenso($mes)
    {
        $meses = array(
            "01" => 'Janeiro',
            "02" => 'Fevereiro',
            "03" => 'Março',
            "04" => 'Abril',
            "05" => 'Maio',
            "06" => 'Junho',
            "07" => 'Julho',
            "08" => 'Agosto',
            "09" => 'Setembro',
            "10" => 'Outubro',
            "11" => 'Novembro',
            "12" => 'Dezembro'
            
        );
        return $meses[$mes];
    }

    function montarArrayDiasMes($ano, $mes)
    {
        if ($mes < 10) {
            $mes = '0' . $mes;
        }
        $primeiroDia = new DateTime("$ano-$mes-01");
        $ultimoDia = new DateTime(date('Y-m-t', strtotime("$ano-$mes-01")));


        $arrayDias = [];

        while ($primeiroDia <= $ultimoDia) {
            
            $dia = $primeiroDia->format('Y-m-d');
            $diaDaSemana = $primeiroDia->format('N');

            $arrayDias[] = [
                'dia' => intval(date('d', strtotime($dia))),
                'data' => $dia,
                'dataFormatada' => date('d/m/Y', strtotime($dia)),
                'diaDaSemana' => $diaDaSemana,
                'diaDaSemanaNome' => $this->getDiaDaSemana($diaDaSemana),
                'registros' => []
            ];

            $primeiroDia->modify('+1 day');
        }

        return $arrayDias;
    }

    function getDiaDaSemana($diaDaSemana)
    {
        $nomes = array(
            1 => 'Segunda-feira',
            2 => 'Terça-feira',
            3 => 'Quarta-feira',
            4 => 'Quinta-feira',
            5 => 'Sexta-feira',
            6 => 'Sábado',
            7 => 'Domingo'
        );
        return $nomes[$diaDaSemana];
    }

    public function filtro(Request $request)
    {
        $funcionarios = Funcionario::where('ativo', true)->orderBy('nome')->get();
        return view('registros.filtro')
            ->with('funcionarios', $funcionarios);
    }
}
