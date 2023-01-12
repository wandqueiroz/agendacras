<?php

namespace App\Http\Controllers;

use App\Http\Requests\Action\ActionCreateRequest;
use App\Models\Agendamento;
use App\Service\Action\ActionService;
use App\Models\Beneficiario;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class DashGeralController extends Controller
{
    private $actionService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActionService $actionService)
    {
        $this->actionService = $actionService;
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($task)
    {
        if($task == 1){
            if (request('dataInicial') && request('dataFinal')) {
                $agendamento = Agendamento::whereBetween('data', array(request('dataInicial'), request('dataFinal')))->orderBy('id', 'desc')->get();
                $agendamento_distinct = Agendamento::select('data', 'unidade')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->distinct()->get();
                $count_agendamentos = count(Agendamento::all());
/*              $count_inseguranca_alimentar = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('tipo_beneficiario', '3')->distinct()->get(['beneficiarios.id']);
                $count_aluguel_social = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('tipo_beneficiario', '2')->distinct()->get(['beneficiarios.id']);
                $count_situacao_rua = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('tipo_beneficiario', '1')->distinct()->get(['beneficiarios.id']);
                $count_deficiencia = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('deficiencia', '!=', '0')->distinct()->get(['beneficiarios.id']);
                $count_restricao_alimentar = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('restricao_alimentar', '!=', '0')->distinct()->get(['beneficiarios.id']);*/
                $grafico = Agendamento::selectRaw('data, count(id) as id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->groupBy('data')->get();
                return view('dashboard.dash_geral', [
                    'agendamento' => $agendamento,
                    'agendamento_distinct' => $agendamento_distinct,
                    'count_agendamentos' => $count_agendamentos,
                    'count_inseguranca_alimentar' => 10,
                    'count_aluguel_social' => 10,
                    'count_situacao_rua' => 10,
                    'count_deficiencia' => 10,
                    'count_restricao_alimentar' => 10,
                    'grafico' => $grafico,
                    'task' => $task
                ]);
            } else {
                $agendamento = Agendamento::orderBy('id', 'desc')->get();
                $agendamento_distinct = Agendamento::select('data', 'unidade')->distinct()->get();
                $count_agendamentos = count(Agendamento::all());
                /* $count_inseguranca_alimentar = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->where('tipo_beneficiario', '3')->distinct()->get(['beneficiarios.id']);
                $count_aluguel_social = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->where('tipo_beneficiario', '0')->distinct()->get(['beneficiarios.id']);
                $count_situacao_rua = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->where('tipo_beneficiario', '1')->distinct()->get(['beneficiarios.id']);
                $count_deficiencia = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->where('deficiencia', '!=', '0')->distinct()->get(['beneficiarios.id']);
                $count_restricao_alimentar = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->where('restricao_alimentar', '!=', '0')->distinct()->get(['beneficiarios.id']); */
                $grafico = Agendamento::selectRaw('data, count(id) as id')->groupBy('data')->get();
                return view('dashboard.dash_geral', [
                    'agendamento' => $agendamento,
                    'agendamento_distinct' => $agendamento_distinct,
                    'count_agendamentos' => $count_agendamentos,
                    'count_inseguranca_alimentar' => 10,
                    'count_aluguel_social' => 10,
                    'count_situacao_rua' =>10,
                    'count_deficiencia' => 10,
                    'count_restricao_alimentar' => 10,
                    'grafico' => $grafico,
                    'task' => $task
                ]);
            }
        }elseif ($task == 2){

            if (request('dataInicial') && request('dataFinal')) {
                $agendamento = Agendamento::whereBetween('data', array(request('dataInicial'), request('dataFinal')))->orderBy('id', 'desc')->get();
                $agendamento_distinct = Agendamento::select('data', 'unidade')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->distinct()->get();
                $count_agendamentos = count(Agendamento::all());
/*              $count_inseguranca_alimentar = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('tipo_beneficiario', '3')->distinct()->get(['beneficiarios.id']);
                $count_aluguel_social = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('tipo_beneficiario', '2')->distinct()->get(['beneficiarios.id']);
                $count_situacao_rua = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('tipo_beneficiario', '1')->distinct()->get(['beneficiarios.id']);
                $count_deficiencia = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('deficiencia', '!=', '0')->distinct()->get(['beneficiarios.id']);
                $count_restricao_alimentar = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('restricao_alimentar', '!=', '0')->distinct()->get(['beneficiarios.id']);*/
                $grafico = Agendamento::selectRaw('data, count(id) as id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->groupBy('data')->get();
                return view('dashboard.dash_geral', [
                    'agendamento' => $agendamento,
                    'agendamento_distinct' => $agendamento_distinct,
                    'count_agendamentos' => $count_agendamentos,
                    'count_inseguranca_alimentar' => 10,
                    'count_aluguel_social' => 10,
                    'count_situacao_rua' =>10,
                    'count_deficiencia' => 10,
                    'count_restricao_alimentar' => 10,
                    'grafico' => $grafico,
                    'task' => $task
                ]);
            } else {
                $agendamento = Agendamento::orderBy('id', 'desc')->get();
                $agendamento_distinct = Agendamento::select('data', 'unidade')->distinct()->get();
                $count_agendamentos = count(Agendamento::all());
                /* $count_inseguranca_alimentar = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->where('tipo_beneficiario', '3')->distinct()->get(['beneficiarios.id']);
                $count_aluguel_social = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->where('tipo_beneficiario', '0')->distinct()->get(['beneficiarios.id']);
                $count_situacao_rua = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->where('tipo_beneficiario', '1')->distinct()->get(['beneficiarios.id']);
                $count_deficiencia = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->where('deficiencia', '!=', '0')->distinct()->get(['beneficiarios.id']);
                $count_restricao_alimentar = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->where('restricao_alimentar', '!=', '0')->distinct()->get(['beneficiarios.id']); */
                $grafico = Agendamento::selectRaw('data, count(id) as id')->groupBy('data')->get();
                return view('dashboard.dash_geral', [
                    'agendamento' => $agendamento,
                    'agendamento_distinct' => $agendamento_distinct,
                    'count_agendamentos' => $count_agendamentos,
                    'count_inseguranca_alimentar' => 10,
                    'count_aluguel_social' => 10,
                    'count_situacao_rua' =>10,
                    'count_deficiencia' => 10,
                    'count_restricao_alimentar' => 10,
                    'grafico' => $grafico,
                    'task' => $task
                ]);
            }
        }

    }
}
