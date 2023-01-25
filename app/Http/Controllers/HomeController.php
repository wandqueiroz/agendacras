<?php

namespace App\Http\Controllers;
use App\Models\Agendamento;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Gate::denies(ability: 'is_ativo')) {
            abort(403, 'Acesso Negado');
        }
        $now = Carbon::now()->format('Y-m-d');
        $user = Auth::user();
        //print_r($user['id_lotacao']);
        //$agendados = Agendamento::all();
        $agendadosCadastro = Agendamento::where('data', $now/* date('Y-m-d' )*/)->where('unidade', $user['id_lotacao'])->where('tipo_atendimento', '1')->get();
        $agendadosTecnico = Agendamento::where('data', $now/* date('Y-m-d' )*/)->where('unidade', $user['id_lotacao'])->where('tipo_atendimento', '2')->get();
        return view('home', ['agendadosCadastro' => $agendadosCadastro, 'agendadosTecnico' => $agendadosTecnico]);

    }
}
