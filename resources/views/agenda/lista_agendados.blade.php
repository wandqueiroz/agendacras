@extends('adminlte::page')

{{-- @section('content_header')
    <h1>FORMULARIO DE REQUERIMENTO</h1>
@stop --}}

<?php

function tipoAtendimento($id)
{
    switch ($id) {
        case 1:
            return 'Novo Cadastro Único';
            break;
        case 2:
            return 'Atualização Cadastral';
            break;
        case 3:
            return 'Declaração de NIS';
            break;
        case 4:
            return 'Psicólogo';
            break;
    }
}

?>

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 mt-4">
                <h1 class="text-center mb-3">Agendamentos do dia</h1>
            </div>
        </div>
        {{-- <p class="text-info">Filtrar por campo</p> <input class="form-control" id="myInput" type="text"
            placeholder="Pesquisar.."> <br> --}}
        <div class="p-4">
            <div class=""></div>
            <a type="button" title="Visualizar" class="btn btn-warning ml-2" id="btnVisualizar" data-toggle="modal"
            data-target="#listaTodos" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-list" aria-hidden="true"></i> Listar todos </a>
            <div class="container-fluid mt-4">
                <table id="myTable" class="table table-atendimento table-bordered table-striped text-nowrap">
                    <thead>
                        <tr>
                            <th hidden scope="col">Id</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Ação</th>
                            <th scope="col">Prioridade</th>
                            {{-- <th scope="col">Data</th> --}}
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agendados as $agendado)
                            <tr>
                                <td hidden class="id">{{ $agendado->id }}</td>
                                <td class="horario">{{ $agendado->horario }}</td>
                                <td class="nome">{{ $agendado->nome }}</td>
                                <td class="cpf">{{ $agendado->cpf }}</td>
                                <td class="tipo">{{ tipoAtendimento($agendado->acao) }}</td>
                                @if ($agendado->prioridade == 0)
                                    <td class="prioridade">NORMAL</td>
                                @else
                                    <td class="prioridade bg-warning">PRIORIDADE</td>
                                @endif
                                {{-- <td class="data">{{ $agendado->data }}</td> --}}


                                <td>
                                    {{-- <button type="button" data-toggle="modal" data-target="#modalVisualizar"
                                        data-toggle="tooltip" data-placement="top" title="Visualizar" class="btn btn-info"
                                        id="btnVisualizar">
                                        <i class="fa fa-eye" aria-hidden="true"></i> </button>
                                    &ensp; --}}
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#modalCheckIn" data-toggle="tooltip" data-placement="top"
                                        title="Check-In de Atendimento" id="btnCheckIn">
                                        <i class="fas fa-user-check"></i> </button>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal Fazer Ckeck-In -->
    <div class="modal fade" id="modalCheckIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Realizar Atendimento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group text-center">

                        <h2 id="txt--modal--atendimento--nome"></h2>
                        <div class="row d-inline-flex p-4">
                            <i class="far fa-clock fa-2x"></i>&nbsp;
                            <h3 id="txt--modal--atendimento--horario"></h3>
                        </div>
                        <h3 id="txt--modal--atendimento--tipo" class="mb-4"></h3>
                        <h3 id="txt--modal--atendimento--prioridade"></h3>

                    </div>

                    <form action="{{ route('agendamento-chamarNovo') }}" method="POST">
                        @csrf
                        <div class="form-group text-center">

                            <input type="text" readonly class="form-control-plaintext" id="nomeAt" name="nome"
                                hidden>
                            <input type="text" readonly class="form-control-plaintext" id="horarioAt" name="horario"
                                hidden>
                            <input type="text" readonly class="form-control-plaintext" id="tipoAt" name="tipo"
                                hidden>
                            <input type="text" readonly class="form-control-plaintext" id="prioridadeAt"name="prioridade"
                                hidden>
                        </div>


                        <div class="row text-center">

                            <div class="col-md-6">
                                <div type="button" class="btn btn-secondary btn--modal" data-dismiss="modal"><i
                                        class="fas fa-window-close"></i>&nbsp Fechar</div>
                            </div>

                            <div class="col-md-6">
                                <button type="button" data-target="#confirmarAtendimento" data-toggle="modal"
                                    class="btn btn-success btn--chama btn--modal"><i class="fas fa-bell">&nbsp</i>Chamar no
                                    painel</button>
                            </div>


                        </div>

                    </form>

                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="confirmarAtendimento" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-atendimento">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-atendimento">
                    <div class="row text-center mb-4">
                        <h5>Sobre o atendimento de </h5>&nbsp;
                        <h5 id="txt--modal--confirma--nome" class="font-weight-bolder"></h5>
                    </div>

                    <form action="{{ route('agendamento-chamarNovo') }}" method="POST">
                        @csrf
                        <div class="form-group text-center">

                            <input type="text" readonly class="form-control-plaintext" id="idAt" name="id"
                                hidden>
                            <div class="form-group col-md-12">
                                <label for="inputTipoNovoAg" class="form-label">Atendimento Realizado?</label>
                                <select class="custom-select" name="tipo_atendimento" required>
                                    <option selected>Selecione</option>
                                    <option value="1">SIM</option>
                                    <option value="2">NÃO</option>
                                    <option value="3">FALTOU</option>
                                </select>
                            </div>


                            <div class="form-group col-md-12">
                                <label for="inputTipoNovoAg" class="form-label">O usuário teve seu problema
                                    solucionado?</label>
                                <select class="custom-select" name="tipo_atendimento" required>
                                    <option selected>Selecione</option>
                                    <option value="1">SIM</option>
                                    <option value="2">NÃO</option>
                                </select>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" data-target="#confirmarAtendimento" data-toggle="modal"
                                class="btn btn-primary">Enviar</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>



    <!-- Modal Listar Todos -->
    <div class="modal  fade" id="listaTodos" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header modal-atendimento">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-atendimento">

                    <div>
                        <table id="myTable" class="table table-atendimento table-bordered table-striped text-nowrap">
                            <thead>
                                <tr>
                                    <th hidden scope="col">Id</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">CPF</th>
                                    <th scope="col">Tipo do Atendimento</th>
                                    <th scope="col">Prioridade</th>
                                    {{-- <th scope="col">Data</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agendados as $agendado)
                                    <tr>
                                        <td hidden class="id">{{ $agendado->id }}</td>
                                        <td class="horario">{{ $agendado->horario }}</td>
                                        <td class="nome">{{ $agendado->nome }}</td>
                                        <td class="cpf">{{ $agendado->cpf }}</td>
                                        <td class="tipo">{{ tipoAtendimento($agendado->tipo_atendimento) }}</td>
                                        @if ($agendado->prioridade == 0)
                                            <td class="prioridade">NORMAL</td>
                                        @else
                                            <td class="prioridade bg-warning">PRIORIDADE</td>
                                        @endif
                                        {{-- <td class="data">{{ $agendado->data }}</td> --}}



                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>

                </div>

            </div>
        </div>
    </div>




    <!-- Modal Visualiza Beneficiario -->
    <div class="modal fade" id="modalVisualizar" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Visualizar Cadastro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4><strong>Visualização do Beneficiário</strong></h4>
                    <div class="row">
                        <div class="col-6" hidden>
                            <strong>ID: </strong>
                            <p id="visualizaId"></p>
                        </div>
                        <div class="col-6">
                            <strong>Data: </strong>
                            <p id="visualizaDt_nascimento"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <strong>Nome: </strong>
                            <p id="visualizaNome"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <strong>CPF: </strong>
                            <p id="visualizaCpf"></p>
                        </div>
                        <div class="col-6">
                            <strong>Celular: </strong>
                            <p id="visualizaCel"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <strong>Nome da Mãe: </strong>
                            <p id="visualizaMae"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <strong>Restrição Alimentar*: </strong>
                            <p id="visualizaRestricao_alimentar"></p>
                        </div>
                        <div class="col-4">
                            <strong>Tipo Beneficiário**: </strong>
                            <p id="visualizaTipo_beneficiario"></p>
                        </div>
                        <div class="col-4">
                            <strong>Deficiencia***: </strong>
                            <p id="visualizaDeficiencia"></p>
                        </div>
                    </div>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>Restrição Alimentar*</strong>
                        <p><i>0-Nenhuma/ 1-Intolerância a Lactose/ 2-Diabetes / 3-Alergia</i></p>
                        <strong>Tipo Beneficiário**</strong>
                        <p><i>1-Morando na rua/ 2-Beneficiário do Aluguel Social</i></p>
                        <strong>Deficiencia***</strong>
                        <p><i>1-Deficiente Físico/ 2-Deficiente Visual ou Auditivo/ 3-Deficiente Mental</i></p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop



@section('css')

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

    <style>
        table th,
        td {
            text-align: center;
        }

        .btn--modal {
            width: 100%;
            height: 5rem;
            font-size: 1.75rem;
            font-weight: bold;
            text-align: center;
            top: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #toast-container .toast.toast-info {
            height: 12rem;
            background-image: url("https://gomake.com.br/wp-content/uploads/2019/07/megaphone-clipart-animation-5.gif") !important;
        }
    </style>

@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d8e2fcabdf.js" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "order": [0, 'asc'],
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'copy',
                    text: 'Copiar',
                }, 'csv', 'excel', 'pdf', 'print'],
                language: {
                    "paginate": {
                        "next": "Próximo",
                        "previous": "Anterior",
                        "first": "Primeira",
                        "last": "Última",
                    },
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ linhas",
                    "infoFiltered": "(filtrado de _MAX_ linhas totais)",
                    "emptyTable": "Sem dados disponíveis na tabela",
                    "search": "Pesquisar:",
                },
                defaults: {
                    pagingType: 'full_numbers',
                    responsive: true,
                }
            });

            $(".dt-buttons button").removeClass('btn-secondary');
            $(".dt-buttons button").addClass('bg-red');
        });
    </script>

    <script>
        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        });


        $(document).on("click", "#btnVisualizar", function() {
            var id = $(this).closest('tr').find(".id").text();
            var nome = $(this).closest('tr').find(".nome").text();
            var dt_nascimento = $(this).closest('tr').find(".dt_nascimento").text();
            var nis = $(this).closest('tr').find(".nis").text();
            var cpf = $(this).closest('tr').find(".cpf").text();
            var mae = $(this).closest('tr').find(".mae").text();
            var restricao_alimentar = $(this).closest('tr').find(".restricao_alimentar").text();
            var tipo_beneficiario = $(this).closest('tr').find(".tipo_beneficiario").text();
            var deficiencia = $(this).closest('tr').find(".deficiencia").text();
            console.log(id);

            console.log(nome);
            var array = {
                id: id,
                nome: nome,
            }

            $('#visualizaId').text(id);
            $('#visualizaNome').text(nome);
            $('#visualizaDt_nascimento').text(dt_nascimento);
            $('#visualizaCel').text(cel);
            $('#visualizaCpf').text(cpf);
            $('#visualizaMae').text(mae);
            $('#visualizaRestricao_alimentar').text(restricao_alimentar);
            $('#visualizaTipo_beneficiario').text(tipo_beneficiario);
            $('#visualizaDeficiencia').text(deficiencia);
        });

        $(document).on("click", "#btnCheckIn", function() {
            var id = $(this).closest('tr').find(".id").text();
            var nome = $(this).closest('tr').find(".nome").text();
            var horario = $(this).closest('tr').find(".horario").text();
            var tipo = $(this).closest('tr').find(".tipo").text();
            var prioridade = $(this).closest('tr').find(".prioridade").text();

            /* console.log(nome);
            console.log(horario);
            console.log(prioridade); */


            $('#txt--modal--atendimento--prioridade').removeClass('bg-warning', 'bg-info');

            $('#txt--modal--atendimento--nome').text(nome);
            $('#txt--modal--confirma--nome').text(nome);
            $('#txt--modal--atendimento--horario').text(horario);
            $('#txt--modal--atendimento--tipo').text(tipo);

            $('#nomeAt').val(nome);
            $('#horarioAt').val(horario);
            $('#tipoAt').val(tipo);
            $('#prioridadeAt').val(prioridade);

            if (prioridade === 'PRIORIDADE') {
                $('#txt--modal--atendimento--prioridade').text('PRIORIDADE').addClass('bg-warning');
            } else {
                $('#txt--modal--atendimento--prioridade').text('NORMAL').addClass('bg-info');
            }

        });

        $(document).on("click", ".btn--chama", function() {
            alert($('#horarioAt').val() + $('#tipoAt').val() + $('#prioridadeAt').val());
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                    type: "POST",
                    url: "chamaNovo",
                    data: {
                        nome: $('#nomeAt').val(),
                        horario: $('#horarioAt').val(),
                        tipo: $('#tipoAt').val(),
                        prioridade: $('#prioridadeAt').val(),
                        _token: _token
                    }
                })
                .done(function(msg) {
                    toastr["info"]('');
                });
        });
    </script>

    <script>
        @if (Session::has('message'))
            toastr.options = {
                //"closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                //"closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                //"closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif


        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "8000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>

    {{-- <script>
            var msg = '{{ Session::get('alert') }}';
            var exist = '{{ Session::has('alert') }}';
            if (exist) {
                var div = $("<div />Mensagem");
                div.attr({
                    id: 'minha_div',
                    title: 'estilo',
                    class: 'alert alert-danger',
                    role: 'alert',
                    value: msg
                });

                $(".container").append(div);
            }
        </script> --}}



    <script>
        $(document).ready(function() {
            $('#inputTelefone').mask('(00) 0 0000-0000');
            $('#inputCpf').mask('000.000.000-00');
        });
    </script>
@stop
