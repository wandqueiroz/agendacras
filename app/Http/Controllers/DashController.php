<?php

namespace App\Http\Controllers;

use App\Http\Requests\Action\ActionCreateRequest;
use App\Models\BeneficiarioAlmoco;
use App\Models\BeneficiarioSopa;
use App\Service\Action\ActionService;
use App\Models\Beneficiario;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class DashController extends Controller
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
    public function index($id_equipamento,$task)
    {
        if($task == 1){
            if (request('dataInicial') && request('dataFinal')) {
                $beneficiarios_refeicao = BeneficiarioAlmoco::whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('equipamento', $id_equipamento)->orderBy('id', 'desc')->get();
                $count_inseguranca_alimentar = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('tipo_beneficiario', '3')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $count_aluguel_social = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('tipo_beneficiario', '=', '2')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $count_situacao_rua = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('tipo_beneficiario', '=', '1')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $count_deficiencia = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('deficiencia', '!=', '0')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $count_restricao_alimentar = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('restricao_alimentar', '!=', '0')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $grafico = BeneficiarioAlmoco::selectRaw('data, count(id) as id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('equipamento', '=', $id_equipamento)->groupBy('data')->get();
                return view('dashboard.dash', [
                    'id_equipamento' => $id_equipamento,
                    'beneficiarios_refeicao' => $beneficiarios_refeicao,
                    'count_inseguranca_alimentar' => $count_inseguranca_alimentar,
                    'count_aluguel_social' => $count_aluguel_social,
                    'count_situacao_rua' => $count_situacao_rua,
                    'count_deficiencia' => $count_deficiencia,
                    'count_restricao_alimentar' => $count_restricao_alimentar,
                    'grafico' => $grafico,
                    'task' => $task
                ]);
            } else {
                $beneficiarios_refeicao = BeneficiarioAlmoco::where('equipamento', $id_equipamento)->orderBy('id', 'desc')->get();
                $count_inseguranca_alimentar = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->where('tipo_beneficiario', '3')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $count_aluguel_social = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->where('tipo_beneficiario', '=', '2')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $count_situacao_rua = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->where('tipo_beneficiario', '=', '1')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $count_deficiencia = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->where('deficiencia', '!=', '0')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $count_restricao_alimentar = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->where('restricao_alimentar', '!=', '0')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $grafico = BeneficiarioAlmoco::selectRaw('data, count(id) as id')->where('equipamento', '=', $id_equipamento)->groupBy('data')->get();
                return view('dashboard.dash', [
                    'id_equipamento' => $id_equipamento,
                    'beneficiarios_refeicao' => $beneficiarios_refeicao,
                    'count_inseguranca_alimentar' => $count_inseguranca_alimentar,
                    'count_aluguel_social' => $count_aluguel_social,
                    'count_situacao_rua' => $count_situacao_rua,
                    'count_deficiencia' => $count_deficiencia,
                    'count_restricao_alimentar' => $count_restricao_alimentar,
                    'grafico' => $grafico,
                    'task' => $task
                ]);
            }
        } else if ($task == 2){
            if (request('dataInicial') && request('dataFinal')) {
                $beneficiarios_refeicao = BeneficiarioSopa::whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('equipamento', $id_equipamento)->orderBy('id', 'desc')->get();
                $count_inseguranca_alimentar = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('tipo_beneficiario', '3')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $count_aluguel_social = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('tipo_beneficiario', '=', '2')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $count_situacao_rua = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('tipo_beneficiario', '=', '1')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $count_deficiencia = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('deficiencia', '!=', '0')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $count_restricao_alimentar = Beneficiario::join('beneficiarios_almoco', 'beneficiarios_almoco.id_beneficiario', '=', 'beneficiarios.id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('restricao_alimentar', '!=', '0')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $grafico = BeneficiarioSopa::selectRaw('data, count(id) as id')->whereBetween('data', array(request('dataInicial'), request('dataFinal')))->where('equipamento', '=', $id_equipamento)->groupBy('data')->get();
                return view('dashboard.dash', [
                    'id_equipamento' => $id_equipamento,
                    'beneficiarios_refeicao' => $beneficiarios_refeicao,
                    'count_inseguranca_alimentar' => $count_inseguranca_alimentar,
                    'count_aluguel_social' => $count_aluguel_social,
                    'count_situacao_rua' => $count_situacao_rua,
                    'count_deficiencia' => $count_deficiencia,
                    'count_restricao_alimentar' => $count_restricao_alimentar,
                    'grafico' => $grafico,
                    'task' => $task
                ]);
            } else {
                $beneficiarios_refeicao = BeneficiarioSopa::where('equipamento', $id_equipamento)->orderBy('id', 'desc')->get();
                $count_inseguranca_alimentar = Beneficiario::join('beneficiarios_sopa', 'beneficiarios_sopa.id_beneficiario', '=', 'beneficiarios.id')->where('tipo_beneficiario', '3')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $count_aluguel_social = Beneficiario::join('beneficiarios_sopa', 'beneficiarios_sopa.id_beneficiario', '=', 'beneficiarios.id')->where('tipo_beneficiario', '=', '2')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $count_situacao_rua = Beneficiario::join('beneficiarios_sopa', 'beneficiarios_sopa.id_beneficiario', '=', 'beneficiarios.id')->where('tipo_beneficiario', '=', '1')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $count_deficiencia = Beneficiario::join('beneficiarios_sopa', 'beneficiarios_sopa.id_beneficiario', '=', 'beneficiarios.id')->where('deficiencia', '!=', '0')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $count_restricao_alimentar = Beneficiario::join('beneficiarios_sopa', 'beneficiarios_sopa.id_beneficiario', '=', 'beneficiarios.id')->where('restricao_alimentar', '!=', '0')->where('equipamento', '=', $id_equipamento)->distinct()->get(['beneficiarios.id']);
                $grafico = BeneficiarioSopa::selectRaw('data, count(id) as id')->where('equipamento', '=', $id_equipamento)->groupBy('data')->get();
                return view('dashboard.dash', [
                    'id_equipamento' => $id_equipamento,
                    'beneficiarios_refeicao' => $beneficiarios_refeicao,
                    'count_inseguranca_alimentar' => $count_inseguranca_alimentar,
                    'count_aluguel_social' => $count_aluguel_social,
                    'count_situacao_rua' => $count_situacao_rua,
                    'count_deficiencia' => $count_deficiencia,
                    'count_restricao_alimentar' => $count_restricao_alimentar,
                    'grafico' => $grafico,
                    'task' => $task
                ]);
            }
        }
    }
}
