@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Sistema de Gestão de Atendimento - SDHDS</h1>
@stop

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <div class="mybtn">
                    <a id="btn3" class="btn btn-lg bg-info" href="/novo_agendamento_cad">
                        <i class="fas fa-calendar-alt"></i>
                        <h4>AGENDAR ATENDIMENTO CADASTRO ÚNICO</h4>

                    </a>

                    <a id="btn3" class="btn btn-lg bg-info" href="/novo_agendamento_tec">
                        <i class="fas fa-calendar-alt"></i>
                        <h4>AGENDAR ATENDIMENTO TÉCNICO</h4>

                    </a>





                    {{-- <a class="btn btn-lg bg-info menu mr-3" href="/novo_agendamento">
                    <i class="fas fa-folder-plus"></i></i> Cadastrar Novo Agendamento
                    </a> --}}
                    <a id="btn3" class="btn btn-lg bg-secondary menu position-relative" href="/lista_agendados">
                        <i class="fa fa-list-ol"></i></i>
                        <h4>LISTAR ATENDIMENTOS CADASTRO ÚNICO</h4>
                        <span class="position-relative top-100 start-100 translate-middle badge rounded-pill bg-warning">
                            {{ count($agendados) }}

                        </span>
                    </a>

                    <a id="btn4" class="btn btn-lg bg-secondary menu position-relative" href="/lista_agendados">
                        <i class="fa fa-list-ol"></i></i>
                        <h4>LISTAR ATENDIMENTOS TÉCNICOS</h4>
                        <span class="position-relative top-0 start-100 translate-middle badge rounded-pill bg-warning">
                            {{ count($agendados) }}

                        </span>
                    </a>
                </div>


            </div>
            <div class="col">
                <div class="home-carousel" style="margin: 2rem 0 0 auto;">

                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>

                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <a href="https://www.fortaleza.ce.gov.br/noticias/secretaria-de-direitos-humanos-abre-selecao-publica-para-14-vagas-de-nivel-superior"
                                    target="_blank">
                                    <img src="{{ asset(config('adminlte.banner')) }}" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p>Clique para mais informações</p>
                                    </div>
                                </a>

                            </div>
                            <div class="carousel-item">

                                <a href="https://desenvolvimentosocial.fortaleza.ce.gov.br/servicos/familia-acolhedora"
                                    target="_blank" rel="noopener noreferrer">
                                    <img src="{{ asset(config('adminlte.banner2')) }}" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p>Clique para mais informações</p>
                                    </div>
                                </a>

                            </div>
                            <div class="carousel-item">
                                <a href="https://www.fortaleza.ce.gov.br/noticias/centros-de-cidadania-oferecem-cursos-profissionalizantes-e-atividade-fisica-para-comunidade"
                                    target="_blank" rel="noopener noreferrer">
                                    <img src="{{ asset(config('adminlte.banner3')) }}" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p>Clique para mais informações</p>
                                    </div>
                                </a>

                            </div>

                        </div>
                        <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </button>
                    </div>


                </div>
            </div>
        </div>

    </div>
@stop

@section('css')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <style>
        .mybtn>.btn {
            width: 20rem;
            height: 13rem;
            margin: 2rem 4px 0 4px;
            text-align: center;
        }

        .mybtn>.btn>i {
            font-size: 2rem;
            margin-top: 20%;
        }

        .mybtn {
            text-align: center;
            margin: 0 auto 0 auto;
        }
    </style>
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
