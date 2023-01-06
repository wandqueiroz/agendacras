@extends('adminlte::page')

@section('title', 'Agendamento')

@section('content_header')
    <h1>Novo agendamento - Cadastro</h1>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section('content')

    <div class="container div-unidades">
        <div class="row mb-4">
            <div class="form-group col-md-5">
                <label for="inputNomeNovoAg" class="form-label">Selecione o Bairro</label>
                <select class="custom-select custom-select-lg mb-3" id="bairro">
                    <option selected>-</option>
                    <option value="1">SÃO JOÃO DO TAUAPE</option>
                    <option value="2">CONJUNTO CEARÁ</option>
                    <option value="3">EDSON QUEIROZ</option>
                </select>
            </div>
            <div class="col-md-1 mt-4" style="text-align:center;">
                <i class="fas fa-arrow-circle-right fa-3x" style="color:rgb(255, 145, 0);"></i>
            </div>
            <div class="form-group col-md-5">
                <label for="inputNomeNovoAg" class="form-label">Unidade de Referência</label>
                <select class="custom-select custom-select-lg mb-3" id="unidade">
                    <option selected>-</option>

                </select>
            </div>
        </div>

    </div>
    <div class="novo-ag-topo">
        <div class="calendar"></div>
        <div class="horarios">
            <div class="horarios-header"></div>
            <div class="horarios-corpo"></div>
        </div>
    </div>


    <div class="modal fade" id="novoAgendamentoModal" tabindex="-1" aria-labelledby="novoAgendamentoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-info" id="novoAgendamentoModalLabel">Novo Agendamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-novo-agendamento">
                        <form action="{{ route('agendamento-store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="inputNomeNovoAg" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="inputNomeNovoAg"
                                        aria-describedby="nomeHelp" name="nome" required>
                                    {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputNomeNovoAg" class="form-label">Perfil Prioritário</label>
                                    <select class="custom-select" name="prioridade" required>
                                        <option value="0">NÃO</option>
                                        <option value="1">BPC</option>
                                        <option value="2">IDOSO</option>
                                        <option value="3">GESTANTE</option>
                                        <option value="4">CRIANÇA DE COLO</option>
                                        <option value="5">DEFICIENTE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="inputCpfNovoAg" class="form-label">CPF</label>
                                    <input type="text" class="form-control" id="inputCpfNovoAg"
                                        aria-describedby="cpfHelp" name="cpf" required>
                                    {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputCelNovoAg" class="form-label">Celular</label>
                                    <input type="text" class="form-control" id="inputCelNovoAg"
                                        aria-describedby="celHelp" name="celular" required>
                                    {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmailNovoAg" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="inputEmailNovoAg"
                                    aria-describedby="emailHelp" name="email" required>
                                {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="inputUnidadeNovoAg" class="form-label">Unidade do Atendimento</label>
                                    <input type="text" class="form-control" id="inputUnidadeNovoAg"
                                        aria-describedby="unidadeHelp" name="unidade" readonly required>
                                    <input type="text" class="form-control" id="inputIdUnidadeNovoAg"
                                        aria-describedby="idUnidadeHelp" name="id_unidade" hidden>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputTipoNovoAg" class="form-label">Tipo do Atendimento</label>
                                    <select class="custom-select" name="tipo_atendimento" required>
                                        <option selected>Selecione</option>
                                        <option value="1">NOVO CADASTRO UNICO</option>
                                        <option value="2">ATUALIZAÇÃO CADASTRAL</option>
                                        <option value="3">DECLARAÇÃO DE NIS</option>
                                        <option value="4">CONSULTA CADASTRAL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group texto col-md-6">
                                    <label for="inputCelNovoAg" class="form-label">Dia</label>
                                    <input type="date" class="form-control" id="inputDiaNovoAg"
                                        aria-describedby="diaHelp" name="data" readonly>
                                </div>
                                <div class="form-group texto col-md-6">
                                    <label for="inputCelNovoAg" class="form-label">Horário</label>
                                    <input type="text" class="form-control" id="inputHorarioNovoAg"
                                        aria-describedby="horarioHelp" name="horario" readonly>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Salvar Agendamento</button>
                            </div>
                            <h5 id="nomeModals"></h5>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


@stop

@section('css')

    <link href="{{ asset('js/FullCalendar/main.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/calendarStyle.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="sweetalert2.min.css">

@stop

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{ asset('js/FullCalendar/main.min.js') }}"></script>
    <script src="{{ asset('js/calendarJavascript.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>





    <script>
        $(document).ready(function() {
            $('#inputCpfNovoAg').mask('000.000.000-00');
            $('#inputCelNovoAg').mask('(00) 0 0000-0000');

            $("#bairro").change(function() {
                $(".horarios-header").empty();
                $(".horarios-corpo").empty();
                var id_bairro = $('#bairro option:selected').val();
                let _token = $('meta[name="csrf-token"]').attr('content');
                $("#unidade").empty();
                $.ajax({
                    url: "/getUnidadePorBairro",
                    type: "POST",
                    data: {
                        id_bairro: id_bairro,
                        _token: _token
                    },
                    success: function(response) {
                        console.log(response.success[0]);

                        for (i = 0; i < response.success.length; i++) {
                            $('#unidade').append($('<option>', {
                                value: response.success[i]['id_unidade'],
                                text: response.success[i]['unidade']
                            }));
                        }

                        //alert('oi');
                        /* if (response) {

                                for (let i = 0; i < response.success.length; ++i) {
                                    let hora_replaced = response.success[i]['horario'].replace(":", "-");
                                    fazer(hora_replaced)
                                }


                            } */
                    },
                    error: function(error) {
                        console.log(error);

                    }
                });
            });

            $("#unidade").change(function() {

                $(".horarios-header").empty();
                $(".horarios-corpo").empty();

            });

        });

        function preencherModal(str, horario) {
            let unidade = $('#unidade').find(":selected").text();
            let id_unidade = $('#unidade').find(":selected").val();
            $('#inputDiaNovoAg').val(str);
            $('#inputHorarioNovoAg').val(horario);
            $('#inputUnidadeNovoAg').val(unidade);
            $('#inputIdUnidadeNovoAg').val(id_unidade);

        }

        @if (Session::has('success'))
            Swal.fire({
                title: 'Feito!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'Ok!'
            });
        @elseif (Session::has('error'))
            Swal.fire({
                title: 'Ops!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'Voltar'
            });
        @endif
    </script>
    <script>
        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus');

        });
    </script>

@stop
