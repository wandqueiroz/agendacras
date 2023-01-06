<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Models\Bairro_unidade;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getLotacao(){

    }

    public function index()
    {
        $now = Carbon::now()->format('Y-m-d');
        $user = Auth::user();
        //print_r($user['id_lotacao']);
        //$agendados = Agendamento::all();
        $agendados = Agendamento::where('data', $now/* date('Y-m-d' )*/)->where('unidade', $user['id_lotacao'])->get();
        return view('agenda.lista_agendados', ['agendados' => $agendados]);
    }


    public function cadastrar_novo()
    {
        return view('agenda.novo_agendamento');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderData(Request $request)
    {
        $dia = $request->get('dia');
        $id_unidade = $request->get('id_unidade');
        $users = Agendamento::where('data', $dia)->where('unidade', $id_unidade)->get();

        //$horarios = array('08:00', '08:40', '09:00', '15:40', '16:00', '11:20', '13:40', '14:20');

        return response()->json(['success'=> $users]);
    }

    public function getUnidadePorBairro(Request $request)
    {
        $id_bairro = $request->get('id_bairro');
        $users = Bairro_unidade::where('id_bairro', $id_bairro)->get();

        //$horarios = array('08:00', '08:40', '09:00', '15:40', '16:00', '11:20', '13:40', '14:20');

        return response()->json(['success'=> $users]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $agendamento = Agendamento::where('data', $request->data)->where('horario', $request->horario)->where('unidade', $request->id_unidade)->get();

        if(!$agendamento->count() && $request->unidade != '-'){
            $agendamento = Agendamento::create([
                'nome' => strtoupper($request->nome),
                'cpf' => $request->cpf,
                'celular' => $request->celular,
                'email' => $request->email,
                'prioridade' => $request->prioridade,
                'unidade' => $request->id_unidade,
                'tipo_atendimento' => $request->tipo_atendimento,
                'data' => $request->data,
                'horario' => $request->horario,
            ]);

            return redirect()->route('agenda-novo_agendamento')->with('success', 'Agendamento realizado com sucesso!');
        }
        else{
            return redirect()->route('agenda-novo_agendamento')->with('error', 'Parece que ocorreu um erro nos dados ou o dia não está mais disponível.');
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function salvar_atendimento(Request $request)
    {

        $agendamento = Agendamento::where('data', $request->data)->where('horario', $request->horario)->where('unidade', $request->id_unidade)->get();

        if(!$agendamento->count() && $request->unidade != '-'){
            $agendamento = Agendamento::create([
                'nome' => strtoupper($request->nome),
                'cpf' => $request->cpf,
                'celular' => $request->celular,
                'email' => $request->email,
                'prioridade' => $request->prioridade,
                'unidade' => $request->id_unidade,
                'tipo_atendimento' => $request->tipo_atendimento,
                'data' => $request->data,
                'horario' => $request->horario,
            ]);

            return redirect()->route('agenda-novo_agendamento')->with('success', 'Agendamento realizado com sucesso!');
        }
        else{
            return redirect()->route('agenda-novo_agendamento')->with('error', 'Parece que ocorreu um erro nos dados ou o dia não está mais disponível.');
        }

    }



    public function chamarNovo(Request $request)
    {
        $user = Auth::user();
        $tipo = "";
        switch ($request->tipo) {
            case 'Atualização Cadastral':
                $tipo = "CADASTRO UNICO";
                break;
            case 'Novo Cadastro Único':
                $tipo = "CADASTRO UNICO";
                break;
            case 'Psicólogo':
                $tipo = "ATENDIMENTO TECNICO";
                break;
        }

        DB::insert('insert into chamadas_temp ( nome,horario,equipamento,perfil_atendimento,prioridade) values (?, ?,?,?, ?)', [strtoupper($request->nome),$request->horario,$user['id_lotacao'],$tipo,strtoupper($request->prioridade)]);

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
