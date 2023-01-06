@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Sistema de Gestão de Atendimento - SDHDS</h1>
@stop

@section('content')
    <div class="container-fluid">
            <a class="btn btn-lg bg-info menu mr-3 dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                aria-expanded="false">

               <i class="fas fa-calendar-alt"></i> Cadastrar Novo Agendamento
            </a>

            <div class="dropdown-menu bg-info">
                <a class="dropdown-item bg-info" href="/novo_agendamento">Cadastro</a>
                <a class="dropdown-item bg-info" href="#">Atendimento Técnico</a>

            </div>

        {{-- <a class="btn btn-lg bg-info menu mr-3" href="/novo_agendamento">
            <i class="fas fa-folder-plus"></i></i> Cadastrar Novo Agendamento
        </a> --}}
        <a class="btn btn-lg bg-info menu position-relative" href="/lista_agendados">
            <i class="fa fa-list-ol"></i></i>
            Listar Agendamentos
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                {{ count($agendados)}}

            </span>
        </a>
    </div>
@stop

@section('css')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <style>


    </style>
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
