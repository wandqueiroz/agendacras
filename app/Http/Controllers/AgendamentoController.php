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

    public function index($task)
    {
        $now = Carbon::now()->format('Y-m-d');
        $user = Auth::user();
        //print_r($user['id_lotacao']);
        //$agendados = Agendamento::all();
        $agendados = Agendamento::where('data', $now/* date('Y-m-d' )*/)->where('unidade', $user['id_lotacao'])->where('tipo_atendimento', $task)->get();
        return view('agenda.lista_agendados', ['agendados' => $agendados, 'task' => $task]);
    }


    public function cadastrar_novo()
    {
        $unidades = DB::select('select * from cras order by nome_cras');
        return view('agenda.novo_agendamento_cad', ['unidades' => $unidades]);
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

    public function getUnidades(Request $request)
    {
        $regional = $request->get('regional');
        $unidades = DB::select('select * from cras where order by nome_cras');

        //$horarios = array('08:00', '08:40', '09:00', '15:40', '16:00', '11:20', '13:40', '14:20');

        return response()->json(['success'=> $unidades]);
    }

      /**
     * .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function buscaBeneficiario(Request $request)
    {
        $modo = $request->get('modo');
        $numero = $request->get('num');
        $beneficiario = DB::select('select * from beneficiarios where '. $modo .' = ' . $numero );

        //$horarios = array('08:00', '08:40', '09:00', '15:40', '16:00', '11:20', '13:40', '14:20');

        return response()->json(['success'=> $beneficiario]);
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
                'tipo_atendimento' => '1',
                'acao' => $request->acao,
                'data' => $request->data,
                'horario' => $request->horario,
            ]);

            return redirect()->route('agenda-novo_agendamento_cad')->with('success', 'Agendamento realizado com sucesso!');
        }
        else{
            return redirect()->route('agenda-novo_agendamento_cad')->with('error', 'Parece que ocorreu um erro nos dados ou o dia não está mais disponível.');
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
                'tipo_atendimento' => '1',
                'acao' => $request->acao,
                'data' => $request->data,
                'horario' => $request->horario,
            ]);

            return redirect()->route('agenda-novo_agendamento_cad')->with('success', 'Agendamento realizado com sucesso!');
        }
        else{
            return redirect()->route('agenda-novo_agendamento_cad')->with('error', 'Parece que ocorreu um erro nos dados ou o dia não está mais disponível.');
        }

    }


    public function chamarNovo(Request $request)
    {
        $user = Auth::user();
        $tipo = "CADASTRO UNICO";

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
