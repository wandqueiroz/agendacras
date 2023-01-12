<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/inicio', function () {
    return view('welcome');
});

/* Route::get('/', function () {
    return view('client/client');
}); */

Route::get('/', function () {
    return view('home');
});

Route::get('/calendario', function () {
    return view('calendario');
});
Auth::routes();

//Route::post('/orderdata/{postdata}', 'SetorPessoalController@orderData');

Route::post('orderdata', [App\Http\Controllers\AgendamentoController::class, 'orderData']);

Route::post('orderdataTec', [App\Http\Controllers\AgendamentoTecController::class, 'orderData']);

Route::post('getUnidadePorBairro', [App\Http\Controllers\AgendamentoController::class, 'getUnidadePorBairro']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Route::get('/requerimento', [App\Http\Controllers\SetorPessoalController::class, 'requerimento'])->name('forms-requerimento'); */

Route::post('/', [\App\Http\Controllers\AgendamentoController::class, 'store'])->name('agendamento-store');

Route::post('/chamaNovo', [\App\Http\Controllers\AgendamentoController::class, 'chamarNovo'])->name('agendamento-chamarNovo');

Route::get('/novo_agendamento_cad', [App\Http\Controllers\AgendamentoController::class, 'cadastrar_novo'])->name('agenda-novo_agendamento_cad');
Route::get('/novo_agendamento_tec', [App\Http\Controllers\AgendamentoTecController::class, 'cadastrar_novo'])->name('agenda-novo_agendamento_tec');

Route::post('/salvar_atendimento_cad', [App\Http\Controllers\AgendamentoController::class, 'salvar_atendimento'])->name('agenda-salvar_atendimento_cad');
Route::post('/salvar_atendimento_tec', [App\Http\Controllers\AgendamentoTecController::class, 'salvar_atendimento'])->name('agenda-salvar_atendimento_tec');

Route::get('/lista_agendados', [App\Http\Controllers\AgendamentoController::class, 'index'])->name('agenda-lista_agendados');

Route::get('/{id}/resetarSenha', [\App\Http\Controllers\AdminController::class, 'resetarSenha'])->where('id', '[0-9]+')->name('resetarSenha');
Route::put('/admin-update', [\App\Http\Controllers\AdminController::class, 'update'])->name('admin-update');

Route::get('/admin/painel', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin-admin_painel');
Route::get('/admin/settings', [App\Http\Controllers\Auth\ResetPasswordController::class, 'changePassword'])->name('change-password');
Route::post('/update-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'updatePassword'])->name('update-password');

Route::get('/{task}/dash_geral', [App\Http\Controllers\DashGeralController::class, 'index'])->name('dashboard-dash_geral');
Route::get('/dash/{id_equipamento}/{task}', [App\Http\Controllers\DashController::class, 'index'])->name('dashboard-dash');
